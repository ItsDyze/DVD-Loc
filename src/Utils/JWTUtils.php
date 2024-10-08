<?php
namespace Utils
{

    use Exception;
    use InvalidArgumentException;

    /* https://www.freecodecamp.org/news/php-jwt-authentication-implementation/
     Implementation standard de JWT
        1. Le header définit le type de token dont il s'agit et son encodage
        2. La payload est la "charge utile" c'est ici que l'on retrouve les informations de validité, et celles utiles à l'application
        3. La signature sert à vérifier que le token n'a pas été altéré

    A chaque étape il est nécessaire de ne pas faire transiter des characters non compatible avec l'encodage URL lors de l'encodage en base64
    */
    class JWTUtils
    {

        function __construct()
        {
        }

        public static function base64URLEncode(string $text): string
        {
            return str_replace(['+', '/', '='],
                                ['-', '_', ''],
                                base64_encode($text));
        }

        private static function base64URLDecode(string $text): string
        {
            return base64_decode(
                str_replace(
                    ["-", "_"],
                    ["+", "/"],
                    $text
                )
            );
        }

        public static function encode(array $payload): string
        {
            $header = json_encode([
                "alg" => "HS256",
                "typ" => "JWT"
            ]);

            $header = self::base64URLEncode($header);
            $payload = json_encode($payload);
            $payload = self::base64URLEncode($payload);

            $signature = hash_hmac("sha256", $header . "." . $payload, getenv("C218_SecurityKey"), true);
            $signature = self::base64URLEncode($signature);
            return $header . "." . $payload . "." . $signature;
        }

        public static function decode(string $token): array
        {
            if (
                preg_match(
                    "/^(?<header>.+)\.(?<payload>.+)\.(?<signature>.+)$/",
                    $token,
                    $matches
                ) !== 1
            ) {

                throw new InvalidArgumentException("Le format du token est invalide.");
            }

            $signature = hash_hmac(
                "sha256",
                $matches["header"] . "." . $matches["payload"],
                getenv("C218_SecurityKey"),
                true
            );

            $signature_from_token = self::base64URLDecode($matches["signature"]);

            if (!hash_equals($signature, $signature_from_token)) {

                throw new Exception("La signature ne correspond pas.");
            }

            return json_decode(self::base64URLDecode($matches["payload"]), true);
        }

        public static function getValue(string $token, string $key): string
        {
            $valueArray = self::decode($token);
            return $valueArray[$key] ?? '';
        }

        public static function isValid(string $token): string
        {
            // On pourrait aller plus loin et vérifier la validité de l'audience et de l'issuer.
            $valueArray = self::decode($token);
            $now = time();
            foreach ($valueArray as $key => $value)
            {
                switch ($key)
                {
                    case 'iat':
                    case 'nbf':
                        if($value > $now)
                        {
                            return false;
                        }
                        break;
                    case 'exp':
                        if($value < $now)
                        {
                            return false;
                        }
                        break;
                    default:
                        break;
                }
            }
            return true;
        }

        public static function isAuthorized($admin = false)
        {
            if (empty($_COOKIE['jwt'])) {
                // Redirect to the login page if the user is not authenticated
                http_response_code(401);
                exit;
            }

            // Decode the JWT token to get user information
            $jwt = JWTUtils::decode($_COOKIE['jwt']);

            if($admin)
            {
                // If a specific role is required, check if the user has that role
                if (!$jwt["isAdmin"]) {
                    // Redirect to an unauthorized page or show an error
                    http_response_code(403);
                    exit;
                }
            }
            return true;
        }
    }
}

