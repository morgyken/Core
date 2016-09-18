<?php

/*
 * =============================================================================
 *
 * Collabmed Solutions Ltd
 * Project: Collabmed Health Platform
 * Author: Samuel Okoth <sodhiambo@collabmed.com>
 *
 * =============================================================================
 */

namespace Ignite\Core\Foundation;

/**
 * Description of ShouldEncrypt
 *
 * @author samuel
 */
trait ShouldEncrypt {

    protected $password = 'continuum';
    protected $IV = 'ThisCouldBeUsBut';
    protected $method = 'aes128';

    public function getAttribute($key) {
        $value = parent::getAttribute($key);
        if (in_array($key, $this->shouldEncrypt) && (!is_null($value))) {
            try {
                //$value = Crypt::decrypt($value);
                $value = openssl_decrypt($value, $this->method, $this->password, OPENSSL_RAW_DATA, $this->IV);
            } catch (Exception $e) {
                dd($e);
            }
        }
        return $value;
    }

    public function setAttribute($key, $value) {
        if (in_array($key, $this->shouldEncrypt)) {
            //$value = Crypt::encrypt($value);
            $value = openssl_encrypt($value, $this->method, $this->password, OPENSSL_RAW_DATA, $this->IV);
        }
        return parent::setAttribute($key, $value);
    }

}
