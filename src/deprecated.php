<?php
use SnelstartPHP\Mapper as Mapper;
use SnelstartPHP\Model as Model;
use SnelstartPHP\Connector as Connector;
use SnelstartPHP\Request as Request;
use SnelstartPHP\Secure as Secure;

if (!class_exists(Model\Verkoopboeking::class)) {
    /**
     * @deprecated Will be removed in the next release.
     */
    \class_alias(Connector\V1\BoekingConnector::class, Connector\BoekingConnector::class);
    \class_alias(Connector\V1\EchoConnector::class, Connector\EchoConnector::class);
    \class_alias(Connector\V1\GrootboekConnector::class, Connector\GrootboekConnector::class);
    \class_alias(Connector\V1\LandConnector::class, Connector\LandConnector::class);
    \class_alias(Connector\V1\RelatieConnector::class, Connector\RelatieConnector::class);
    \class_alias(Mapper\V1\BoekingMapper::class, Mapper\BoekingMapper::class);
    \class_alias(Mapper\V1\GrootboekMapper::class, Mapper\GrootboekMapper::class);
    \class_alias(Mapper\V1\LandMapper::class, Mapper\LandMapper::class);
    \class_alias(Mapper\V1\RelatieMapper::class, Mapper\RelatieMapper::class);
    \class_alias(Model\Adres::class, Model\V1\CorrespondentieAdres::class);
    \class_alias(Model\Adres::class, Model\V1\VestigingsAdres::class);
    \class_alias(Model\V1\Bijlage::class, Model\Bijlage::class);
    \class_alias(Model\V1\Boeking::class, Model\Boeking::class);
    \class_alias(Model\V1\Boekingsregel::class, Model\Boekingsregel::class);
    \class_alias(Model\V1\Btwregel::class, Model\Btwregel::class);
    \class_alias(Model\V1\Dagboek::class, Model\Dagboek::class);
    \class_alias(Model\V1\Grootboek::class, Model\Grootboek::class);
    \class_alias(Model\V1\Inkoopboeking::class, Model\Inkoopboeking::class);
    \class_alias(Model\V1\InkoopboekingBijlage::class, Model\InkoopboekingBijlage::class);
    \class_alias(Model\V1\Relatie::class, Model\Relatie::class);
    \class_alias(Model\V1\RgsCode::class, Model\RgsCode::class);
    \class_alias(Model\V1\Verkoopboeking::class, Model\Verkoopboeking::class);
    \class_alias(Model\V1\VerkoopboekingBijlage::class, Model\VerkoopboekingBijlage::class);
    \class_alias(Request\V1\BoekingRequest::class, Request\BoekingRequest::class);
    \class_alias(Request\V1\EchoRequest::class, Request\EchoRequest::class);
    \class_alias(Request\V1\GrootboekRequest::class, Request\GrootboekRequest::class);
    \class_alias(Request\V1\LandRequest::class, Request\LandRequest::class);
    \class_alias(Request\V1\RelatieRequest::class, Request\RelatieRequest::class);

    \class_alias(Secure\V1Connector::class, Secure\AuthenticatedConnection::class);
}