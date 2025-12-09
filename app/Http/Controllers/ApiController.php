<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use SimpleXMLElement;

abstract class ApiController extends Controller
{
    protected function respond($data, int $status = 200)
    {
        $acceptHeader = request()->header('Accept', 'application/json');

        // Check if client wants XML
        if (str_contains($acceptHeader, 'application/xml') ||
            str_contains($acceptHeader, 'text/xml')) {
            return $this->xmlResponse($data, $status);
        }

        // Default to JSON
        return response()->json($data, $status);
    }

    protected function xmlResponse($data, int $status = 200)
    {
        $json = json_encode($data);
        $dataAsArray = json_decode($json, true);

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><response/>');
        $this->arrayToXml($dataAsArray, $xml);

        return response($xml->asXML(), $status)
            ->header('Content-Type', 'application/xml');
    }

    protected function arrayToXml(array $data, SimpleXMLElement $xml): void
    {
        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                $key = 'item';
            }

            if (is_array($value)) {
                $subnode = $xml->addChild($key);
                $this->arrayToXml($value, $subnode);
            } else {
                $xml->addChild($key, htmlspecialchars((string) $value ?? ''));
            }
        }
    }
}
