<?php


namespace App\Service\Generic\Upload;


use App\Service\Generic\Log\LoggerService;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\KernelInterface;

class UploadService
{
    /**
     * @var LoggerService
     */
    private $logger;
    /**
     * @var KernelInterface
     */
    private $appKernel;

    public function __construct(KernelInterface $appKernel, LoggerService $loggerService)
    {
        $this->appKernel = $appKernel;
        $this->logger = $loggerService;
    }

    public function upload($targetDirectory, UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = transliterator_transliterate(
            'Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
            $originalFilename
        );

        $guessExtension = $file->guessExtension();
        $ext = !$guessExtension ? 'bin' : $guessExtension;
        $fileName = $safeFilename.'-'.uniqid().'.'.$ext;

        try {
            $file->move($targetDirectory, $fileName);
        } catch (FileException $e) {
            $this->logger->getSlackService()->sendSlackException($e);

            return false;
        }

        return $fileName;
    }

}