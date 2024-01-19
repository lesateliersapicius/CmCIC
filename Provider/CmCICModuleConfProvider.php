<?php

namespace CmCIC\Provider;

use ApyUtilities\Provider\AbstractPaymentModuleConf;
use CmCIC\CmCIC;
use stdClass;

/**
 * Class CmCICModuleConfProvider
 * @package CmCIC\Provider
 */
class CmCICModuleConfProvider extends AbstractPaymentModuleConf
{
    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return 'CmCIC';
    }

    /**
     * @inheritDoc
     */
    public function getID(): string
    {
        return self::getJsonData('CMCIC_TPE');
    }

    /**
     * @inheritDoc
     */
    public function getActive(): bool
    {
        return !empty(self::getJsonData('CMCIC_TPE'));
    }

    /**
     * @inheritDoc
     */
    public function getData(): stdClass
    {
        return (object)[
            'CMCIC_TPE'         => self::getJsonData('CMCIC_TPE'),
            'CMCIC_KEY'         => self::getJsonData('CMCIC_KEY'),
            'CMCIC_CODESOCIETE' => self::getJsonData('CMCIC_CODESOCIETE'),
            'CMCIC_SERVER'      => self::getJsonData('CMCIC_SERVER')
        ];
    }

    /**
     * Récupère les données dans le fichier JSON selon la clé donnée en paramètre
     * @param string $key
     * @return mixed
     */
    private function getJsonData(string $key)
    {
        $values = null;
        $path   = __DIR__ . '/../' . CmCIC::JSON_CONFIG_PATH;
        if (is_readable($path)) {
            $values = json_decode(file_get_contents($path), true);
        }

        return $values[$key];
    }
}
