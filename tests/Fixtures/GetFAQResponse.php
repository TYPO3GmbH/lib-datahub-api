<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use GuzzleHttp\Psr7\Response;

return new Response(200, ['content-type' => 'application/json'], '
{
  "identifier": "test-faq",
  "format": "json",
  "content": "{\"label\":\"ELTS\",\"identifier\":\"elts\",\"icon\":\"actions-shield\",\"description\":\"Test with ELTS\",\"sections\":[{\"label\":\"Common\",\"identifier\":\"common\",\"questions\":[{\"label\":\"What??\",\"identifier\":\"what\",\"blocks\":[{\"description\":\"<p>Whaaaat?<\\\/p>\",\"image_url\":null,\"image_position\":\"left\"}]}]}]}",
  "version": "latest"
}
');
