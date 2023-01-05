<?php
/**
 * @package     Fox5\Tests\Unit\Component\Courtrolls\Site\Controller
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Joomla\Tests\Unit\Component\Courtrolls\Site\Table\Component\Courtrolls\Site\Controller;

use Fox5\Component\Courtroll\Site\Controller\DisplayController;

class DisplayControllerTest extends \Joomla\Tests\Unit\UnitTestCase
{
    protected function setUp(): void
    {
        $this->displayController = $this->createMock(DisplayController::class);
        parent::setUp();
    }

    public function testDisplayControllerReturn()
    {
        $this->displayController->expects($this->once())
            ->method('display')
            ->willReturn($this->displayController);

        $displayObject = $this->displayController->display();

        $this->assertIsObject($displayObject);
        $this->assertInstanceOf(DisplayController::class, $displayObject);
    }
}
