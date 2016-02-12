<?php

namespace SNicholson\IPFO\Parsers\SmartParsers;

use SNicholson\IPFO\Helpers\DateParser;
use SNicholson\IPFO\Helpers\IPFOXML;
use WorkAnyWare\IPFO\IPF;
use WorkAnyWare\IPFO\IPRightInterface;
use SNicholson\IPFO\Parsers\RecursiveFieldSearch;
use WorkAnyWare\IPFO\IPRights\Priority;

class PrioritiesParser
{

    public static function parse(IPFOXML $XML, IPRightInterface &$IPRight)
    {
        $priorities = RecursiveFieldSearch::getAllFieldsMatchingNameByArray(['priorities', 'priority-claims'], $XML);
        if ($priorities) {
            /** @var IPFOXML $priorityXML */
            foreach ($priorities as $priorityXML) {
                /** @var IPFOXML $number */
                $number = RecursiveFieldSearch::searchByNameArray(['number', 'doc-number'], $priorityXML);
                if ($number) {
                    $priority   = Priority::fromNumber($number);
                    $priority->setDate(
                        DateParser::EPO(
                            RecursiveFieldSearch::searchByNameArray(['date'], $priorityXML)
                        )
                    );
                    $priority->setCountry(RecursiveFieldSearch::searchByNameArray(['country'], $priorityXML));
                    $IPRight->addPriority($priority);
                }
            }
        }
    }
}