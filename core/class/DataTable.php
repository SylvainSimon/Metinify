<?php

use \Shared\DoctrineHelper;
use \Doctrine\ORM\Query\Expr;
use Carbon\Carbon;

class DataTable {

    private $_em;
    private $_qb;
    private $_qbCountTotal;
    private $_qbCountDisplay;
    private $_entityName;
    private $_entityAlias;
    private $request = null;
    private $response = null;
    private $customParameters = array();
    private $columnsParameters = array();
    private $arrOrderBy = array();
    private $arrSelect = array();
    private $arrWhere = array();
    private $arrIn = array();
    private $arrNotIn = array();
    private $arrJoin = array();
    private $arrParameter = array();
    private $groupBy = '';
    private $isDistinct = false;

    public function __construct() {
        $this->_em = DoctrineHelper::getEntityManager();
        $this->_qb = $this->_em->createQueryBuilder();
        $this->_qbCountTotal = $this->_em->createQueryBuilder();
        $this->_qbCountDisplay = $this->_em->createQueryBuilder();
    }

    public function from($from, $alias) {
        $this->setEntityName($from);
        $this->setEntityAlias($alias);
        return $this;
    }

    public function join($type, $join, $alias, $conditionType = null, $condition = null, $indexBy = null) {
        $this->arrJoin[] = array(
            'type' => $type,
            'join' => $join,
            'alias' => $alias,
            'conditionType' => $conditionType,
            'condition' => $condition,
            'indexBy' => $indexBy
        );
        return $this;
    }

    public function innerJoin($join, $alias, $conditionType = null, $condition = null, $indexBy = null) {
        $this->join('innerJoin', $join, $alias, $conditionType, $condition, $indexBy);
        return $this;
    }

    public function leftJoin($join, $alias, $conditionType = null, $condition = null, $indexBy = null) {
        $this->join('leftJoin', $join, $alias, $conditionType, $condition, $indexBy);
        return $this;
    }

    public function addSelect($select) {
        $this->arrSelect[] = $select;
        return $this;
    }

    public function andWhere($where) {
        $this->arrWhere[] = array(
            'where' => $where
        );
        return $this;
    }

    public function andIn($field, $where) {
        $this->arrIn[] = array(
            'field' => $field,
            'where' => $where
        );
        return $this;
    }

    public function andNotIn($field, $where) {
        $this->arrNotIn[] = array(
            'field' => $field,
            'where' => $where
        );
        return $this;
    }

    public function addOrderBy($sort, $order = null) {
        $this->arrOrderBy[] = array(
            'sort' => $sort,
            'order' => $order
        );
        return $this;
    }

    public function setParameter($key, $value) {
        $this->arrParameter[] = array(
            'key' => $key,
            'value' => $value
        );

        return $this;
    }

    public function groupBy($groupBy) {
        $this->groupBy = $groupBy;
        return $this;
    }

    public function distinct() {
        $this->isDistinct = true;
    }

    /**
     * Set customParameters
     * 
     * @param type $customParameters
     * @return \Common\DataTable
     */
    public function setCustomParameters($customParameters) {
        $this->customParameters = $customParameters;

        return $this;
    }

    public function getCustomParameters() {
        return $this->customParameters;
    }

    /**
     * Set columnsParameters
     * 
     * @param type $columnsParameters
     * @return \Common\DataTable
     */
    public function setColumnsParameters($columnsParameters) {
        $this->columnsParameters = $columnsParameters;

        return $this;
    }

    public function getColumnsParameters() {
        return $this->columnsParameters;
    }

    /**
     * Set _entityName
     * 
     * @param type $_entityName
     * @return \Common\DataTable
     */
    private function setEntityName($_entityName) {
        $this->_entityName = $_entityName;

        return $this;
    }

    private function getEntityName() {
        return $this->_entityName;
    }

    /**
     * Set _entityAlias
     * 
     * @param type $_entityAlias
     * @return \Common\DataTable
     */
    private function setEntityAlias($_entityAlias) {
        $this->_entityAlias = $_entityAlias;

        return $this;
    }

    private function getEntityAlias() {
        return $this->_entityAlias;
    }

    /**
     * Set request
     * 
     * @param type $request
     * @return \Common\DataTable
     */
    public function setRequest($request) {
        $this->request = $request;

        return $this;
    }

    public function getRequest() {
        return $this->request;
    }

    /**
     * Set response
     * 
     * @param type $response
     * @return \Common\DataTable
     */
    public function setResponse($response) {
        $this->response = $response;

        return $this;
    }

    public function getResponse() {
        return $this->response;
    }

    /**
     * Select
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     * @param array $columns
     */
    private function getSelectStatement(\Doctrine\ORM\QueryBuilder $queryBuilder, $columns) {
        foreach ($columns as $column) {
            if ($column['dbField'] and $column['dtField']) {
                $dbField = $column['dbField'];
                $dbSeparator = ($column['dbConcatSeparator'] != '') ? $column['dbConcatSeparator'] : ',';

                if (is_array($dbField) and count($dbField) > 0) {

                    foreach ($dbField AS $idfield => $field) {

                        if ($column["dbSortReplaceField"]) {
                            foreach ($column["dbSortReplaceField"] AS $fieldBefore => $fieldAfter) {

                                if ($field == $fieldBefore) {
                                    $dbField[$idfield] = "IFELSE(" . $fieldBefore . " IS NULL, " . $fieldAfter . ", " . $field . ")";
                                }
                            }
                        }
                    }

                    $field = $this->concatFields($dbField, $dbSeparator);
                } else {
                    $field = $dbField;
                }

                $queryBuilder->addSelect($field . " as " . $column['dtField']);
            }
        }

        if (count($this->arrSelect) > 0) {
            foreach ($this->arrSelect as $select) {
                $queryBuilder->addSelect($select);
            }
        }
    }

    /**
     * Join
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     */
    private function getJoinStatement(\Doctrine\ORM\QueryBuilder $queryBuilder) {
        if (count($this->arrJoin) > 0) {
            foreach ($this->arrJoin as $join) {
                $queryBuilder->{$join['type']}($join['join'], $join['alias'], $join['conditionType'], $join['condition'], $join['indexBy']);
            }
        }
    }

    /**
     * Where
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     */
    private function getWhereStatement(\Doctrine\ORM\QueryBuilder $queryBuilder) {
        if (count($this->arrWhere) > 0) {
            $cnt = 0;
            foreach ($this->arrWhere as $where) {
                if ($cnt > 0) {
                    $queryBuilder->andWhere($where['where']);
                } else {
                    $queryBuilder->where($where['where']);
                }
                $cnt++;
            }
        }
    }

    /**
     * Where
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     */
    /**
      private function getHavingStatement(\Doctrine\ORM\QueryBuilder $queryBuilder, $request, $columns) {

      foreach ($columns as $column) {

      if ($column['havingField']) {

      $cnt = 0;

      for ($i = 0; $i < intval($request['iColumns']); $i++) {

      if ($_GET['sSearch_' . $i] != '' && $request['sSearch_' . $i] != '~' && strrpos("undefined~undefined", $request['sSearch_' . $i]) === false) {

      \Debug::log($_GET['sSearch_' . $i]);

      if ($request['bSearchable_' . $i] == "true") {

      $value = $request['sSearch_' . $i];

      if ($cnt > 0) {
      $queryBuilder->andHaving("" . $column['havingField'] . " LIKE '%" . $value . "%'");
      } else {
      $queryBuilder->having("" . $column['havingField'] . " LIKE '%" . $value . "%'");
      }

      $cnt++;
      }
      }
      }
      }
      }
      }
     */

    /**
     * NotIn
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     */
    private function getNotInStatement(\Doctrine\ORM\QueryBuilder $queryBuilder) {
        if (count($this->arrNotIn) > 0) {
            foreach ($this->arrNotIn as $notIn) {
                $queryBuilder->andWhere($notIn['field'] . ' NOT IN (' . $notIn['where'] . ')');
            }
        }
    }

    /**
     * In
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     */
    private function getInStatement(\Doctrine\ORM\QueryBuilder $queryBuilder) {
        if (count($this->arrIn) > 0) {
            foreach ($this->arrIn as $in) {
                $queryBuilder->andWhere($in['field'] . ' IN (' . $in['where'] . ')');
            }
        }
    }

    /**
     * Parameters
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     */
    private function getParameters(\Doctrine\ORM\QueryBuilder $queryBuilder) {
        if (count($this->arrParameter) > 0) {
            foreach ($this->arrParameter as $parameter) {
                $queryBuilder->setParameter($parameter['key'], $parameter['value']);
            }
        }
    }

    /**
     * Paginate
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     * @param array $request
     */
    private function getLimitStatement(\Doctrine\ORM\QueryBuilder $queryBuilder, $request) {
        if (isset($request['iDisplayStart']) && $request['iDisplayLength'] != '-1') {
            $queryBuilder->setFirstResult((int) $request['iDisplayStart'])
                    ->setMaxResults((int) $request['iDisplayLength']);
        }
    }

    /**
     * Group By
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     * @param array $request
     */
    private function getGroupByStatement(\Doctrine\ORM\QueryBuilder $queryBuilder) {
        if ($this->groupBy !== '') {
            $queryBuilder->groupBy($this->groupBy);
        }
    }

    /**
     * Ordering
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     * @param array $request
     * @param array $columns
     */
    private function getOrderStatement(\Doctrine\ORM\QueryBuilder $queryBuilder, $request, $columns) {

        if (count($this->arrOrderBy) > 0) {
            foreach ($this->arrOrderBy as $orderBy) {
                $queryBuilder->addOrderBy($orderBy['sort'], $orderBy['order']);
            }
        }

        if (isset($request['iSortCol_0'])) {
            for ($i = 0; $i < intval($request['iSortingCols']); $i++) {
                $numCol = intval($request['iSortCol_' . $i]);
                if ($request['bSortable_' . $numCol] == "true") {

                    $dtField = $request['mDataProp_' . $numCol];

                    foreach ($columns as $column) {
                        if ($column['dtField'] === $dtField) {
                            $field = $column['dtField'];
                            $sortField = $column['dbSortField'];
                            continue;
                        }
                    }


                    $query = $field;
                    $queryBuilder->addOrderBy($query, $request['sSortDir_' . $i]);
                }
            }
        }
    }

    /**
     * Search
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     * @param array $request
     * @param array $columns
     */
    private function getFilterStatement(\Doctrine\ORM\QueryBuilder $queryBuilder, $request, $columns) {
        /**
         * Column filtering
         */
        if (isset($request['sSearch_0'])) {
            $aLike = array();
            for ($i = 0; $i < intval($request['iColumns']); $i++) {
                if ($_GET['sSearch_' . $i] != '' && $request['sSearch_' . $i] != '~' && strrpos("undefined~undefined", $request['sSearch_' . $i]) === false) {

                    if ($request['bSearchable_' . $i] == "true") {
                        $value = $request['sSearch_' . $i];
                        $dtField = $request['mDataProp_' . $i];

                        foreach ($columns as $column) {
                            if ($column['dtField'] === $dtField) {
                                $dbSeparator = ($column['dbConcatSeparator'] != '') ? $column['dbConcatSeparator'] : " ";
                                $field = $column['dbField'];
                                $type = $column['dbType'];
                                continue;
                            }
                        }

                        if(!isset($request['sRangeSeparator'])){
                            $request['sRangeSeparator'] = "~";
                        }
                        
                        $separator = $request['sRangeSeparator'];
                        $pos = strpos($value, $separator);

                        // Champ date
                        if ($pos !== false and strlen($value) > 1) {
                            $arrValues = explode($separator, $value);

                            if ($arrValues[0] !== '') {
                                list($jDeb, $mDeb, $aDeb) = explode('/', $arrValues[0]);
                                $dtDebut = Carbon::createFromDate($aDeb, $mDeb, $jDeb)->startOfDay();
                                $dateDebut = $dtDebut->format('Y-m-d');
                                $stampDebut = $dtDebut->getTimestamp();
                            } else {
                                $dateDebut = '0000-00-00';
                                $stampDebut = 0;
                            }

                            if ($type === 'timestamp') {
                                $queryBuilder->andWhere($field . " >= :stampDebut")
                                        ->setParameter('stampDebut', $stampDebut);
                            } else {
                                $queryBuilder->andWhere($field . " >= :dateDebut")
                                        ->setParameter('dateDebut', $dateDebut);
                            }

                            if ($arrValues[1] !== '') {
                                list($jFin, $mFin, $aFin) = explode('/', $arrValues[1]);
                                $dtFin = Carbon::createFromDate($aFin, $mFin, $jFin)->endOfDay();
                                $dateFin = $dtFin->format('Y-m-d');
                                $stampFin = $dtFin->getTimestamp();
                            } else {
                                $dateFin = date('Y-m-d');
                                $stampFin = time();
                            }

                            if ($type === 'timestamp') {
                                $queryBuilder->andWhere($field . " <= :stampFin")
                                        ->setParameter('stampFin', $stampFin);
                            } else {
                                $queryBuilder->andWhere($field . " <= :dateFin")
                                        ->setParameter('dateFin', $dateFin);
                            }
                        } else {
                            if (is_array($field)) {
                                $concat = $this->searchConcatFields($field, $dbSeparator);
                                $aLike[] = $queryBuilder->expr()->like($concat, '\'%' . strtolower($value) . '%\'');
                            } else {
                                $aLike[] = $queryBuilder->expr()->like($field, '\'%' . $value . '%\'');
                            }
                        }
                    }
                }
            }
            if (count($aLike) > 0) {
                $queryBuilder->andWhere(new Expr\Andx($aLike));
            } else {
                unset($aLike);
            }
        }
    }

    public function getResult() {
        $request = $this->getRequest();
        $columns = $this->getColumnsParameters();

        $queryBuilder = $this->_qb;
        $entity = $this->getEntityName();
        $alias = $this->getEntityAlias();

        $queryBuilder->from($entity, $alias);
        $this->getSelectStatement($queryBuilder, $columns);
        $this->getJoinStatement($queryBuilder);
        $this->getWhereStatement($queryBuilder);
        //$this->getHavingStatement($queryBuilder, $request, $columns);
        $this->getNotInStatement($queryBuilder);
        $this->getInStatement($queryBuilder);
        $this->getGroupByStatement($queryBuilder);
        $this->getParameters($queryBuilder);
        $this->getFilterStatement($queryBuilder, $request, $columns);
        $this->getOrderStatement($queryBuilder, $request, $columns);
        $this->getLimitStatement($queryBuilder, $request);

        if ($this->isDistinct) {
            $queryBuilder->distinct();
        }

        // Total
        $queryBuilderTotal = $this->_qbCountTotal;
        $queryBuilderTotal->from($entity, $alias);
        $queryBuilderTotal->select('COUNT (DISTINCT(' . $alias . '))');
        $this->getJoinStatement($queryBuilderTotal);
        $this->getWhereStatement($queryBuilderTotal);
        $this->getNotInStatement($queryBuilderTotal);
        $this->getInStatement($queryBuilderTotal);
        $this->getParameters($queryBuilderTotal);

        // Affichage
        $queryBuilderDisplay = $this->_qbCountDisplay;
        $queryBuilderDisplay->from($entity, $alias);
        $queryBuilderDisplay->select('COUNT (DISTINCT(' . $alias . '))');
        $this->getJoinStatement($queryBuilderDisplay);
        $this->getWhereStatement($queryBuilderDisplay);
        $this->getNotInStatement($queryBuilderDisplay);
        $this->getInStatement($queryBuilderDisplay);
        $this->getParameters($queryBuilderDisplay);
        $this->getFilterStatement($queryBuilderDisplay, $request, $columns);

        if ($this->isDistinct) {
            $queryBuilder->distinct();
        }

        /**
         * SQL queries
         * Get data to display
         */
        /* Total data set length */
        $totalRecords = (int) $queryBuilderTotal->getQuery()->getSingleScalarResult();


        // On évite de faire des requêtes pour rien
        if ($totalRecords > 0) {
            $aResult = $queryBuilder->getQuery()->getArrayResult();

            /* Data set length after filtering */
            $totalDisplayRecords = (int) $queryBuilderDisplay->getQuery()->getSingleScalarResult();
        } else {
            $aResult = array();
            $totalDisplayRecords = 0;
        }

        unset($queryBuilderTotal);
        unset($queryBuilderDisplay);
        unset($queryBuilder);


        /**
         * Output
         */
        $output = array(
            "sEcho" => intval($request['sEcho']),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => intval($totalDisplayRecords),
            "aaData" => $this->renderData($columns, $aResult)
        );

        $this->setResponse($output);

        return $this;
    }

    public function toJson() {
        header("Content-type: application/json");
        header("Pragma: no-cache");
        header("Expires: 0");
        
        echo json_encode($this->getResponse());
        exit;
    }

    public function toStringFile() {

        return $this->getResponse();
    }

    public function toString() {
        header("Content-type: application/text");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo serialize($this->getResponse());
        exit;
    }

    private function renderData($columns, $data) {
        $out = array();

        for ($i = 0, $ien = count($data); $i < $ien; $i++) {
            $row = array();

            for ($j = 0, $jen = count($columns); $j < $jen; $j++) {
                $column = $columns[$j];

                if (isset($column['formatter'])) {
                    $row[$column['dtField']] = $column['formatter']($data[$i][$column['dtField']], $data[$i], $this->customParameters);
                } else {
                    $row[$column['dtField']] = $data[$i][$column['dtField']];
                }
            }

            $out[] = $row;
        }

        return $out;
    }

    private function concatFields($fields, $separator = ',') {
        $separator = ",'" . $separator . "',";
        $return = "concat(";
        foreach ($fields as $field) {
            $return .= $field . $separator;
        }
        $return = rtrim($return, $separator) . ")";
        return $return;
    }

    private function searchConcatFields($fields, $separator = ',') {
        $separator = ",'" . $separator . "',";
        $return = "concat(";
        foreach ($fields as $field) {
            $return .= "IFELSE(LOWER(" . $field . ") IS NULL, '', " . $field . ")" . $separator;

        }
        $return = rtrim($return, $separator) . ")";
        return $return;
    }

}
