<?php

namespace Steam\Adapter;

use JMS\Serializer\SerializerInterface;
use Steam\Configuration;

abstract class AdapterAbstract
{
    /**
     * @var Configuration
     */
    protected $_config = null;

    /**
     * @var string
     */
    protected $_baseSteamApi = '';

    /**
     * @var string
     */
    protected $_rawBody = '';

    /**
     * @var mixed
     */
    protected $_parsedBody = '';

    /**
     * @var SerializerInterface
     */
    protected $_serializer = null;

    /**
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->setConfig($config);
    }

    /**
     * @param Configuration $config
     *
     * @return AdapterInterface
     */
    public function setConfig(Configuration $config)
    {
        $this->_config = $config;
        return $this;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->_config;
    }

    /**
     * @param SerializerInterface $serializer
     */
    public function setSerializer(SerializerInterface $serializer)
    {
        $this->_serializer = $serializer;
    }

    /**
     * @return SerializerInterface
     */
    public function getSerializer()
    {
        return $this->_serializer;
    }

    /**
     * @return string
     */
    public function getRawBody()
    {
        return $this->_rawBody;
    }

    /**
     * @return mixed
     */
    public function getParsedBody()
    {
        return $this->getSerializer()->deserialize($this->getRawBody(), 'array', 'json');
    }
}