<?php
/**
 * Created by IntelliJ IDEA.
 * User: erdal
 * Date: 20.02.2018
 * Time: 09:40
 */

namespace Couch;

use Couch\Doc\Fields\Mixed_;
use Couchbase\Cluster;

/**
 * Class Bucket
 * @package Couch
 */
abstract class Bucket
{
    Const PARAM_NAME_END_FIX_FOR_RESERVED_WORDS ="_name";
    /**
     * @var \Couchbase\Bucket
     */
    private $bucket;

    /**
     * Bucket constructor.
     * @param Cluster $cluster
     */
    public function __construct(Cluster $cluster)
    {
        $this->setBucket($cluster->openBucket($this->getBucketName()));
    }

    /**
     * @return \Couchbase\Bucket
     */
    public function getBucket()
    {
        return $this->bucket;
    }

    /**
     * @param \Couchbase\Bucket $bucket
     * @return $this
     */
    public function setBucket(\Couchbase\Bucket $bucket)
    {
        $this->bucket = $bucket;
        return $this;
    }

    /**
     * @return string
     */
    public abstract function getBucketName();

    /**
     * @param Doc $doc
     * @param string $id
     * @return array|\Couchbase\Document
     */
    public function upsert(Doc $doc, $id)
    {
        return $this->bucket->upsert((string)$id, $doc->toArray(true));
    }

    /**
     * update like sql
     * @param Doc $doc
     * @param Mixed_ $where
     * @return bool|object
     * @throws \Exception
     */
    public function update(Doc $doc, Mixed_ $where)
    {
        $unset = [];
        $set = [];
        $namedParams = [];
        $sql = "UPDATE `" . $this->getBucketName()."`";

        if (count($doc->toArray()) === 0) {
            return false;
        }

        foreach ($doc->getFields() as $field) {

            if ($field instanceof Doc\Fields\Unset_) {
                $unset[] = $field->getName();

            } else {
                $fixedFieldName =  $field->getName().self::PARAM_NAME_END_FIX_FOR_RESERVED_WORDS;

                $set[] = $field->getName() . '=$' .$fixedFieldName;

                $namedParams[$fixedFieldName] = $field->getValue();
            }
        }

        if (count($set) > 0) {
            $sql .= " SET " . implode(",", $set);
        }

        if (count($unset) > 0) {
            $sql .= " UNSET " . implode(",", $unset);
        }

        if (count($unset) > 0 || count($set) > 0) {

            $sql .= ' WHERE ' . $where->getName() . '=$whereValue';

            $namedParams["whereValue"] = $where->getValue();

            $query = \CouchbaseN1qlQuery::fromString($sql);
            $query->namedParams($namedParams);

            return $this->bucket->query($query);
        }

        return false;
    }

    /**
     * @param Mixed_ $where
     * @return object
     */
    public function delete(Mixed_ $where)
    {
        $sql = "DELETE FROM `" . $this->getBucketName() . "` WHERE " . $where->getName() . '=$' . $where->getName();

        $query = \CouchbaseN1qlQuery::fromString($sql);
        $query->namedParams([
            $where->getName() => $where->getValue()
        ]);

        return $this->bucket->query($query);
    }
}