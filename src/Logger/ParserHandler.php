<?php

namespace BA\ParserBundle\Logger;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

class ParserHandler extends AbstractProcessingHandler
{
    private $storageLogs;

    public function __construct(ParserStorageLogs $storageLogs, $level = Logger::NOTICE, $bubble = true)
    {
        $this->storageLogs = $storageLogs;

        parent::__construct($level, $bubble);
    }

    /**
     * {@inheritDoc}
     */
    protected function write(array $record)
    {
        $message = json_decode($record['message'], 1);

        if ($message && $message['context'] == 'parser' && !$this->storageLogs->isExistError(array(
            'id'      => $message['id'],
            'message' => $message['message'], 
            'level'   => $record['level_name']
        ))) {
            $this->storageLogs->addError(array(
                'id'      => $message['id'],
                'message' => $message['message'], 
                'level'   => $record['level_name'],
                'date'    => $record['datetime']
            ));
        }
    }
}
