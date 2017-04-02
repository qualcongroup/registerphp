<?php
	class EnumManejadorBD {
	        const MYSQL=0;
                const SQLSERVER=1;
                const ORACLE=2;
                const SQLLITE=3;
	}

	class EnumOperacion {
	        const SELECCIONAR=0;
                const INSERTAR=1;
                const ACTUALIZAR=2;
                const ELIMINAR=3;
                const STORED_PROCEDURE=4;
                const ELIMINAR_TODO=5;
	}
?>