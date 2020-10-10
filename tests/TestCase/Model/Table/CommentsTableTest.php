<?php
declare(strict_types=1);

namespace Lovesafe\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Lovesafe\Model\Table\CommentsTable;

/**
 * Lovesafe\Model\Table\CommentsTable Test Case
 */
class CommentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Lovesafe\Model\Table\CommentsTable
     */
    protected $Comments;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Lovesafe.Comments',
        'plugin.Lovesafe.Files',
        'plugin.Lovesafe.Passwords',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Comments') ? [] : ['className' => CommentsTable::class];
        $this->Comments = TableRegistry::getTableLocator()->get('Comments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Comments);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
