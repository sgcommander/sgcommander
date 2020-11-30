<?php
	/**
	 * sgcommander - models/EspecialModel.php
	 *
	 * $Id$
	 *
	 * This file is part of sgcommander.
	 *
	 * Automatically generated on 06.11.2009, 15:12:09 with ArgoUML PHP module 
	 * (last revised $Date: 2008-04-19 08:22:08 +0200 (sáb, 19 abr 2008) $)
	 *
	 * @author David & Jose
	 * @package models
	 * @since 15/07/2009
	 */
	
	
	
	/**
	 * Short description of class EspecialModel
	 *
	 * @access public
	 * @author David & Jose
	 * @package models
	 * @since 15/07/2009
	 */
	class EspecialModel
	    extends ModelBase
	{
		private function especialesUnidades($idJugador){
			//Obtengo los heroes del jugador
			$consulta = $this->db->query('
							SELECT uh.idUnidad
                       		FROM unidadJugadorPlaneta AS ujp
					 		LEFT JOIN unidadHeroe AS uh ON (ujp.idUnidad=uh.idUnidad AND ujp.idJugador=\''.$idJugador.'\')
						');
			
			$unidades = Array();
			
			while($row=$consulta->fetch_assoc()){
				$unidades[$row['idUnidad']]=TRUE;
			}
			
			$consulta->close();
			
			//Obtengo los requerimientos de los especiales
			$consulta = $this->db->query('
							SELECT idEspecial, idUnidadHeroe
							FROM especialRequiereUnidadHeroe
						');
			
			$especial = Array();		//Contiene si se cumple los requisitos de  mejoras para cada especial
			$especialFinal = Array();	//Contiene los id de los especiales
			
			while($row=$consulta->fetch_assoc()){
				//Si es la primera vez que se pasa por el especial se anyade a los arrays
				if(!array_key_exists($row['idEspecial'], $especial)){
					$especial[$row['idEspecial']]=TRUE;
					$especialFinal[$row['idEspecial']]=TRUE;
				}
				
				//Si el especial no ha sido descartado, no se tiene una de las mejoras o no se cumple un nivel se elimina
				if($especial[$row['idEspecial']] && (!array_key_exists($row['idUnidadHeroe'], $unidades))){
					$especial[$row['idEspecial']]=FALSE;
					unset($especialFinal[$row['idEspecial']]);
				}
			}
				
			return array_keys($especialFinal);
		}
		
		private function especialesMejora($idJugador){
			//Obtengo las mejoras del jugador
			$consulta = $this->db->query('
							SELECT idMejora, nivel
                       		FROM jugadorMejora
                       		WHERE idJugador=\''.$idJugador.'\'
						');
			
			$mejoras = Array();
			
			while($row=$consulta->fetch_assoc()){
				$mejoras[$row['idMejora']]=$row['nivel'];
			}
			
			$consulta->close();
			
			//Obtengo los requerimientos de los especiales
			$consulta = $this->db->query('
							SELECT idEspecial, idMejora, nivel
							FROM especialRequiereMejoraNormal
						');
			
			$especial = Array();		//Contiene si se cumple los requisitos de  mejoras para cada especial
			$especialFinal = Array();	//Contiene los id de los especiales
			
			while($row=$consulta->fetch_assoc()){
				//Si es la primera vez que se pasa por el especial se anyade a los arrays
				if(!array_key_exists($row['idEspecial'], $especial)){
					$especial[$row['idEspecial']]=TRUE;
					$especialFinal[$row['idEspecial']]=TRUE;
				}
				
				//Si el especial no ha sido descartado, no se tiene una de las mejoras o no se cumple un nivel se elimina
				if($especial[$row['idEspecial']] && (!array_key_exists($row['idMejora'], $mejoras) || $mejoras[$row['idMejora']] < $row['nivel'])){
					$especial[$row['idEspecial']]=FALSE;
					unset($especialFinal[$row['idEspecial']]);
				}
			}
			
			return array_keys($especialFinal);
		}
		
	    public function especiales($idJugador)
	    {
	    	//Seleccciona los especiales de planestas y los que estan activos o recargando
	    	$consulta = $this->db->query('
	    		SELECT erp.idEspecial
				FROM especialRequierePlaneta erp 
					JOIN planetaColonizado pc ON erp.idPlanetaEsp=pc.idPlaneta AND erp.idGalaxia=pc.idGalaxia AND pc.idJugador=\''.$idJugador.'\'
				UNION
				SELECT idEspecial
				FROM jugadorEspecialActivo
				WHERE idJugador=\''.$idJugador.'\'
				UNION
				SELECT idEspecial
				FROM jugadorEspecialEspera
				WHERE idJugador=\''.$idJugador.'\'
	    	');
	    	
	    	$idEspeciales = Array();
	    	
	    	while($row=$consulta->fetch_row()){
	    		$idEspeciales[] = $row[0];
	    	}
	    	
	    	$consulta->close();
	    	
	    	$idEspeciales=array_merge($idEspeciales, $this->especialesUnidades($idJugador), $this->especialesMejora($idJugador));

	    	//Consulto los datos de los especiales necesarios
	        $consulta = $this->db->query('
	        	SELECT e.idEspecial, e.nombre, e.especificacion, e.descripcion, e.tiempoRecarga, e.tiempoDuracion, 
	        	COALESCE(TIMESTAMPDIFF(SECOND,NOW(),jee.tiempoFinalEspera), 0) AS tiempoRecargaRestante,
	        	COALESCE(TIMESTAMPDIFF(SECOND,NOW(),jea.finEspecial), 0) AS tiempoDuracionRestante, activo
	        	FROM especial AS e 
	        	LEFT JOIN jugadorEspecialEspera AS jee ON e.idEspecial=jee.idEspecial AND jee.idJugador=\''.$idJugador.'\'
	        	LEFT JOIN jugadorEspecialActivo AS jea ON e.idEspecial=jea.idEspecial AND jea.idJugador=\''.$idJugador.'\'
	        	WHERE e.idEspecial IN (\''.implode('\',\'', $idEspeciales).'\')');
	        
	        $datos=array();
	        
			for($i=0; $i<$consulta->num_rows; $i++) {
				$datos[$i]=$consulta->fetch_assoc();
			}
	        
	        $consulta->close();
	        
			return array_filter($datos, function($element) {
				return $element['activo'];
			});
	    }
	
	    /**
	     * Activa un especial
	     *
	     * @access public
	     * @author David & Jose
	     * @param  Integer idJugador
	     * @param  Integer idEspecial
	     * @param  Integer idGalaxiaOrigen
	     * @param  Integer idPlanetaOrigen
	     * @param  Integer idGalaxiaDestino
	     * @param  Integer idPlanetaDestino
	     * @return mixed
	     * @since 15/07/2009
	     */
	    public function activar($idJugador, $idEspecial, $idGalaxiaOrigen = null, $idPlanetaOrigen = null, $idGalaxiaDestino = null, $idPlanetaDestino = null)
	    {
	        
	        $this->db->query(
	        	'INSERT INTO jugadorEspecialActivo (idEspecial, idJugador, idExplorador, idGalaxia, idPlaneta, finEspecial)
	        	VALUES (\''.$idEspecial.'\', \''.$idJugador.'\', \''.$idJugador.'\', \''.$idGalaxiaOrigen.'\', \''.$idPlanetaOrigen.'\', NULL)');
	        
	        return $this->db->errno==0;
	        
	    }
	
	}
?>