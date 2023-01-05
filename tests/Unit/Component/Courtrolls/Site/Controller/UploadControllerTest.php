<?php
/**
 * @package     Fox5\Tests\Unit\Component\Courtrolls\Site\Controller
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Joomla\Tests\Unit\Component\Courtrolls\Site\Table\Component\Courtrolls\Site\Controller;

use Fox5\Component\Courtroll\Site\Controller\UploadController;

class UploadControllerTest extends \Joomla\Tests\Unit\UnitTestCase
{
    protected function setUp(): void
    {
        $this->uploadController = $this->createMock(UploadController::class);
        parent::setUp();
    }

    public function testUploadController()
    {
        $this->uploadController->expects($this->once())
            ->method('execute')
            ->willReturn($this->uploadController);

        $this->assertInstanceOf(UploadController::class, $this->uploadController->execute('upload'));
    }

    public function testUploadControllerUploadsFile()
    {
        $this->uploadController->expects($this->once())
            ->method('execute')
            ->willReturn($this->uploadController);

        $resultObject = $this->uploadController->execute('upload');

        $this->assertInstanceOf(UploadController::class, $resultObject);
    }
}