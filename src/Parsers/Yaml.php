<?php

namespace Blog\Parsers;

use Symfony\Component\Yaml\Yaml as YamlParser;

class Yaml implements Parser
{
    public function parse($contents)
    {
        return YamlParser::parse((string)$contents);
    }
}