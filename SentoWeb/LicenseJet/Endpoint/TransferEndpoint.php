<?php namespace SentoWeb\LicenseJet\Endpoint;

use SentoWeb\LicenseJet\Model\License;

Class TransferEndpoint extends Endpoint {
    public function create_transfer(License $license, $recipient = null, $preserve_license_keys = false) {
        return $this->post('license/'.$license->getId().'/actions', [
            'action' => 'transfer',
            'recipient' => $recipient,
            'preserve_license_keys' => $preserve_license_keys
        ]);
    }
}