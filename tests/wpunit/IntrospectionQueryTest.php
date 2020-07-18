<?php

class IntrospectionQueryTest extends \Codeception\TestCase\WPTestCase
{

    public function setUp(): void {
        // before
        parent::setUp();

        // your set up methods here
    }

    public function tearDown(): void {
        // your tear down methods here

        // then
        parent::tearDown();
    }

    // Validate schema.
    public function testSchema() {
        try {
            $request = new \WPGraphQL\Request();
            $request->schema->assertValid();

            // Assert true upon success.
            $this->assertTrue( true );
        } catch (\GraphQL\Error\InvariantViolation $e) {
            // use --debug flag to view.
            codecept_debug( $e->getMessage() );

            // Fail upon throwing
            $this->assertTrue( false );
        }
    }

    // Test introspection query.
    public function testIntrospectionQuery() {
        $query   = \GraphQL\Type\Introspection::getIntrospectionQuery();
        $results = graphql( array( 'query' => $query ) );

        $this->assertArrayNotHasKey('errors', $results );
    }
}
