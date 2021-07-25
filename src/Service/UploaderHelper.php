<?php


namespace App\Service;

use App\Entity\Gift;
use App\Entity\Receiver;
use App\Repository\GiftRepository;
use App\Repository\ReceiverRepository;
use Exception;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Uid\Uuid;

class UploaderHelper
{

    private GiftRepository $giftRepository ;
    private ReceiverRepository $receiverRepository;

    public function __construct(GiftRepository $giftRepository, ReceiverRepository $receiverRepository)
    {
        $this->giftRepository = $giftRepository;
        $this->receiverRepository = $receiverRepository;
    }

    public function importFileData(File $file)
    {
        try {
            $file_content = file($file);
            array_shift($file_content);

            foreach ($file_content as $data) {
                $row_data = explode(',', $data);
                $receiver = $this->createReceiver($row_data);
                if (null == $receiver) { continue; }
                $gift = $this->createGift($row_data, $receiver);

                $this->receiverRepository->add($receiver);
                $this->giftRepository->add($gift);
            }
        } catch (Exception $e) {
        }
    }

    private function createReceiver(array $data)
    {
        if(Uuid::isValid($data[4])) {
            return new Receiver(Uuid::fromString($data[4]), $data[5], $data[6], $data[7]);
        }
        return null;
    }

    private function createGift(array $data, Receiver $receiver)
    {
        if(Uuid::isValid($data[0])) {
            return new Gift(Uuid::fromString($data[0]), $data[1], $data[2], (float)$data[3], $receiver);
        }
        return null;
    }

}