<?php
declare(strict_types=1);

namespace Lovesafe\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Lovesafe\Model\Table\PasswordsTable;

/**
 * Lovesafe\Model\Table\PasswordsTable Test Case
 */
class PasswordsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Lovesafe\Model\Table\PasswordsTable
     */
    protected $Passwords;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Lovesafe.Passwords',
        'plugin.Lovesafe.Comments',
        'plugin.Lovesafe.Files',
        'plugin.Lovesafe.Telephones',
        'plugin.Lovesafe.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Passwords') ? [] : ['className' => PasswordsTable::class];
        $this->Passwords = TableRegistry::getTableLocator()->get('Passwords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Passwords);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
