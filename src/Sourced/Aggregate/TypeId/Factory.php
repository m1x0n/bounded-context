<?php namespace BoundedContext\Sourced\Aggregate\TypeId;

use BoundedContext\Contracts\Command\Command;
use BoundedContext\Sourced\Aggregate\ClassFactory;
use BoundedContext\Contracts\Generator\Identifier as IdentifierGenerator;

class Factory implements \BoundedContext\Contracts\Sourced\Aggregate\TypeId\Factory
{
    private $class_factory;
    private $identifier_generator;
    
    public function __construct(
        ClassFactory $class_factory, 
        IdentifierGenerator $identifier_generator)
    {
        $this->class_factory = $class_factory;
        $this->identifier_generator = $identifier_generator;
    }
    
    /**
     * @param Command $command
     * @return Identifier
     */
    public function command(Command $command)
    {
        $aggregate_class = $this->class_factory->command($command);
        return $this->aggregate_class($aggregate_class);
    }
    
    private function parse_doc_comment(string $doc_comment)
    {
        $clean_doc_comment = trim(preg_replace('/\r?\n *\* *\//', '', $doc_comment));

        $comments = [];
        preg_match_all('/@([a-z]+)\s+(.*?)\s*(?=$|@[a-z]+\s)/s', $clean_doc_comment, $comments);

        return array_combine($comments[1], $comments[2]);
    }
    
    /**
     * @param string $aggregate_class
     * @return Identifier
     * @throws \Exception
     */
    public function aggregate_class($aggregate_class) 
    {
        $class_reflection = new \ReflectionClass($aggregate_class);
        
        $doc_block_vars = $this->parse_doc_comment( $class_reflection->getDocComment() );
        if (!isset($doc_block_vars['id'])) {
            throw new \Exception("Aggregate class '$aggregate_class' does not have an ID param in it's docblock. Cannot process.");
        }
        return $this->identifier_generator->string($doc_block_vars['id']);
    }
}
