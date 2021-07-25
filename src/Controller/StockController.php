<?php

namespace App\Controller;

use App\Repository\GiftRepository;
use App\Repository\ReceiverRepository;
use App\Service\UploaderHelper;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StockController extends AbstractController
{

    /**
     * @Route("/stock/import", name="stock", methods={"POST"})
     * @param Request $request
     * @param ReceiverRepository $receiverRepository
     * @param GiftRepository $giftRepository
     * @return JsonResponse
     */
    public function index(Request $request, ReceiverRepository $receiverRepository, GiftRepository $giftRepository): JsonResponse
    {
        try {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $request->files->get('file');
            $helper = new UploaderHelper($giftRepository, $receiverRepository);
            $helper->importFileData($uploadedFile);
            return new JsonResponse();
        } catch (Exception $e) {
            return new JsonResponse($e->getMessage());
        }
    }
}
