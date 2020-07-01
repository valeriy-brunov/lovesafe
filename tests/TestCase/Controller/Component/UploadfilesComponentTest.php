<?php
declare(strict_types=1);

namespace Lovesafe\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use Lovesafe\Controller\Component\UploadfilesComponent;

/**
 * Lovesafe\Controller\Component\UploadfilesComponent Test Case
 */
class UploadfilesComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Lovesafe\Controller\Component\UploadfilesComponent
     */
    protected $Uploadfiles;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Uploadfiles = new UploadfilesComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Uploadfiles);

        parent::tearDown();
    }
}
