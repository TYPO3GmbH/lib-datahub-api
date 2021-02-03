<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Exception;

use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class DatahubResponseException extends Exception
{
    private const MESSAGES = [
        404 => 'The resource you are trying to access does not exist.',
        403 => 'You do not have permissions to perform this action.',
        401 => 'Authorization is required to perform this action.',
    ];

    private const DEFAULT = 'Something went wrong, please try again in a few minutes';

    private RequestInterface $request;

    private ResponseInterface $response;

    public function __construct(RequestInterface $request, ResponseInterface $response, Throwable $previous = null)
    {
        $message = self::MESSAGES[$response->getStatusCode()] ?? self::DEFAULT;
        try {
            $data = json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR);
            if (isset($data['errors']) && 0 < count($data['errors'])) {
                $errorString = $this->composeErrorList($data['errors']);
                if (!empty($errorString)) {
                    $message = $errorString;
                }
            }
        } catch (\JsonException $e) {
            $message = 'Response contained invalid JSON';
        }

        parent::__construct($message, $response->getStatusCode(), $previous);
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @param array<int, string|array<int, mixed>> $errors
     * @return string
     */
    private function composeErrorList(array $errors): string
    {
        $errorString = '';
        foreach ($errors as $key => $error) {
            if (is_string($error)) {
                $errorString .= (!is_numeric($key) ? ($key . ': ') : '') . $error . PHP_EOL;
                continue;
            }

            if (is_array($error)) {
                $errorString .= $this->composeErrorList($error);
                continue;
            }
        }

        return $errorString;
    }
}
