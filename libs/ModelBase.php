<?php

/**
 * Modelo base del que heredan el resto de modelos
 *
 * @author David & Jose
 * @package libs
 * @since 21/01/2009
 */

/**
 * Modelo base del que heredan el resto de modelos
 *
 * @abstract
 * @access public
 * @author David & Jose
 * @package libs
 * @since 21/01/2009
 */
abstract class ModelBase
{
    
    // generateAssociationEnd : ModelBase

    

    /**
     * Variable SPDO
     *
     * @access protected
     * @since 26/01/2009
     */
    protected $db = null;

    

    /**
     * Constructor de la clase
     *
     * @access public
     * @author David & Jose
     * @return mixed
     * @since 21/01/2009
     */
    public function __construct()
    {
        //Obtengo la abstraccion de la base de datos con transacciones
        $this->db = SPDO::singleton(TRUE);
        
    }

} /* end of abstract class ModelBase */

?>