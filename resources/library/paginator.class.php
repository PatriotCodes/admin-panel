<?php

class Paginator
{
    private $_limit;
    private $_db;
    private $_tableName;
    private $_idName;
    private $_page;

    public function __construct( $db, $tableName, $limit, $idName ) {
        $this->_db = $db;
        $this->_tableName = $tableName;
        $this->_limit = $limit;
        $this->_idName = $idName;
    }

    public function getData($page,$likeClause,$orderClause,$innerJoin,$names) {
        $this->_page = $page;
        $limit = $page * $this->_limit;
        $offset = ($limit - $this->_limit) + 1;
        $str = $this->_idName;
        foreach ($names as $name) {
            if ($name == 'row') {
                continue;
            }
            $str .= ", ";
            $str .= $name;
        }
        if ($orderClause != '' && $likeClause != '') {
            $result = $this->_db->query("SELECT * FROM ( 
            SELECT ".$str.", ROW_NUMBER() OVER (ORDER BY ".$this->_idName.") as row 
            FROM ".$this->_tableName." ".$innerJoin.") a WHERE row BETWEEN ".$offset." AND ".$limit."
             ".$likeClause." ".$orderClause.";");
        } elseif ($orderClause != '') {
            $result = $this->_db->query("SELECT * FROM ( 
            SELECT ".$str.", ROW_NUMBER() OVER (ORDER BY ".$this->_idName.") as row 
            FROM ".$this->_tableName." ".$innerJoin.") a WHERE row BETWEEN ".$offset." AND ".$limit."
             ".$orderClause.";");
        } elseif ($likeClause != '') {
            $result = $this->_db->query("SELECT * FROM ( 
            SELECT ".$str.", ROW_NUMBER() OVER (ORDER BY ".$this->_idName.") as row 
            FROM ".$this->_tableName." ".$innerJoin.") a WHERE row BETWEEN ".$offset." AND ".$limit."
             ".$likeClause.";");
        } else {
            $result = $this->_db->query("SELECT * FROM ( 
            SELECT ".$str.", ROW_NUMBER() OVER (ORDER BY ".$this->_idName.") as row 
            FROM ".$this->_tableName." ".$innerJoin.") a WHERE row BETWEEN ".$offset." AND ".$limit.";");
        }
        return $result;
    }

    public function outputNavigation() {
        $rows = $this->_db->rowCount($this->_tableName,$this->_idName);
        $pages = $rows / $this->_limit;
        if ($pages > 0) {
            echo '<nav aria-label="Page navigation example">';
            echo '<ul class="pagination justify-content-center">';
            if ($this->_page != 1) {
                echo '<li class="page-item"><a class="page-link" href="?page='.($this->_page - 1).'">Предыдущая страница</a></li>';
            } else {
                echo '<li class="page-item disabled"><a class="page-link" href="?page='.($this->_page - 1).'">Предыдущая страница</a></li>';
            }
            for ($index = 0; $index < $pages; $index++) {
                if (($index + 1) == $this->_page) {
                    echo '<li class="page-item active"><a class="page-link" href="?page='.($index + 1).'">'.($index + 1);
                } else {
                    echo '<li class="page-item"><a class="page-link" href="?page='.($index + 1).'">'.($index + 1);
                }
                echo '</a></li>';
            }
            if (($pages > 1) && ($this->_page != $pages)) {
                echo '<li class="page-item"><a class="page-link" href="?page='.($this->_page + 1).'">Следующая страница</a></li>';
            } else {
                echo '<li class="page-item disabled"><a class="page-link" href="?page='.($this->_page + 1).'">Следующая страница</a></li>';
            }
        }
        echo '</ul>';
        echo '</nav>';
    }
}