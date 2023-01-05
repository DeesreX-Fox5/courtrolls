<?php
/**
 * @package     Fox5\Tests\Unit\Component\Courtrolls\Site\Controller
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Joomla\Tests\Unit\Component\Courtrolls\Site\Table\Component\Courtrolls\Site\Controller;

use Fox5\Component\Courtroll\Site\Controller\CourtrollController;

class CourtrollControllerTest extends \Joomla\Tests\Unit\UnitTestCase
{
    protected function setUp(): void
    {
        $this->courtrollController = $this->createMock(CourtrollController::class);
        parent::setUp();
    }

    public function testCourtrollController()
    {
        $this->courtrollController->expects($this->once())
            ->method('execute')
            ->willReturn($this->courtrollController);

        $toExecute = 'delete';
        $this->assertInstanceOf(CourtrollController::class, $this->courtrollController->execute($toExecute));
    }
}