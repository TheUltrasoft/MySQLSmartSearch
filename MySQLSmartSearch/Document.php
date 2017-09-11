<?php

namespace MySQLSmartSearch;


class Document{

    protected $fields, $content, $ID;

    const FIELD_MAX_SIZE = 32;

    /**
     * Create a MySQLSmartSearch Document.
     * @param array|NULL $fields
     * @param array $content
     */
    public function __construct(array $fields = NULL, array $content = []){
        $this->fields($fields);
        $this->content($content);
    }


    /**
     * Get all fields registered with this document.
     * @return mixed
     */
    public function getFields(){
        return $this->fields;
    }

    /**
     * Set fields for this document.
     * @param array|NULL $fields
     * @throws \Exception
     */
    protected function fields(array $fields = NULL){

        if( $fields !== NULL AND !is_array( $fields )){
            throw new \Exception('Fields must be an array or NULL');
        }

        if( empty( $fields ) ){
            $this->fields = NULL;
        }else{
            foreach( $fields as $field ){
                $field = strtolower( substr($field, self::FIELD_MAX_SIZE) );
                $this->fields[$field] = $field;
            }
        }
    }

    /**
     * @param null|string $ID
     * @throws \Exception
     */
    public function ID($ID = NULL){

        if($ID === NULL){
            return $this->ID;
        }

        if( !is_scalar( $ID ) ){
            throw new \Exception('ID must be a scalar entity');
        }
        $this->ID = $ID;
    }

    /**
     * Add some content to the document
     * @param null|array|string $content
     * @throws \Exception
     * @internal param string $ID
     */
    public function content($content = NULL){

        if($content === NULL){
            return $this->content;
        }

        if( $this->fields === NULL ){
            if( !is_string( $content ) ){
                throw new \Exception('Expects content to be string');
            }

            $this->content = $content;

        }else{

            if( !is_array( $content ) ){
                throw new \Exception('Expects content to be an array');
            }

            foreach ($this->fields as $field){
                if( isset( $content[$field] ) ){
                    $this->content[$field] = $content[$field];
                }
            }
        }
    }

}