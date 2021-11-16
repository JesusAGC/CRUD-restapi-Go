<?php
if (class_exists('class_ticket_turno.php') != true) {
    class ticket_turno
    {
        protected $turno_id;
        protected $turno_nombreCompleto;
        protected $turno_CURP;
        protected $turno_Nombre;
        protected $turno_Paterno;
        protected $turno_Materno;
        protected $turno_Telefono;
        protected $turno_Celular;
        protected $turno_Email;
        protected $turno_Nivel;
        protected $turno_Municipio;
        protected $turno_Asunto;

        public function __construct(
            $turno_id = null,
            $turno_nombreCompleto = null,
            $turno_CURP = null,
            $turno_Nombre = null,
            $turno_Paterno = null,
            $turno_Materno = null,
            $turno_Telefono = null,
            $turno_Celular = null,
            $turno_Email = null,
            $turno_Nivel = null,
            $turno_Municipio = null,
            $turno_Asunto = null
        ) {
            $this->turno_id = $turno_id;
            $this->turno_nombreCompleto = $turno_nombreCompleto;
            $this->turno_CURP = $turno_CURP;
            $this->turno_Nombre = $turno_Nombre;
            $this->turno_Paterno = $turno_Paterno;
            $this->turno_Materno = $turno_Materno;
            $this->turno_Telefono = $turno_Telefono;
            $this->turno_Celular = $turno_Celular;
            $this->turno_Email = $turno_Email;
            $this->turno_Nivel = $turno_Nivel;
            $this->turno_Municipio = $turno_Municipio;
            $this->turno_Asunto = $turno_Asunto;

        } //END CONSTRUCTOR
        /**
         * Get the value of turno_id
         */
        public function getTurnoId()
        {
            return $this->turno_id;
        }

        /**
         * Set the value of turno_id
         *
         *
         */
        public function setTurnoId($turno_id)
        {
            $this->turno_id = $turno_id;

            return $this;
        }

        /**
         * Get the value of turno_nombreCompleto
         */
        public function getTurnoNombreCompleto()
        {
            return $this->turno_nombreCompleto;
        }

        /**
         * Set the value of turno_nombreCompleto
         *
         *
         */
        public function setTurnoNombreCompleto($turno_nombreCompleto)
        {
            $this->turno_nombreCompleto = $turno_nombreCompleto;

            return $this;
        }

        /**
         * Get the value of turno_CURP
         */
        public function getTurnoCURP()
        {
            return $this->turno_CURP;
        }

        /**
         * Set the value of turno_CURP
         *
         *
         */
        public function setTurnoCURP($turno_CURP)
        {
            $this->turno_CURP = $turno_CURP;

            return $this;
        }

        /**
         * Get the value of turno_Nombre
         */
        public function getTurnoNombre()
        {
            return $this->turno_Nombre;
        }

        /**
         * Set the value of turno_Nombre
         *
         *
         */
        public function setTurnoNombre($turno_Nombre)
        {
            $this->turno_Nombre = $turno_Nombre;

            return $this;
        }

        /**
         * Get the value of turno_Paterno
         */
        public function getTurnoPaterno()
        {
            return $this->turno_Paterno;
        }

        /**
         * Set the value of turno_Paterno
         *
         *
         */
        public function setTurnoPaterno($turno_Paterno)
        {
            $this->turno_Paterno = $turno_Paterno;

            return $this;
        }

        /**
         * Get the value of turno_Materno
         */
        public function getTurnoMaterno()
        {
            return $this->turno_Materno;
        }

        /**
         * Set the value of turno_Materno
         *
         *
         */
        public function setTurnoMaterno($turno_Materno)
        {
            $this->turno_Materno = $turno_Materno;

            return $this;
        }

        /**
         * Get the value of turno_Telefono
         */
        public function getTurnoTelefono()
        {
            return $this->turno_Telefono;
        }

        /**
         * Set the value of turno_Telefono
         *
         *
         */
        public function setTurnoTelefono($turno_Telefono)
        {
            $this->turno_Telefono = $turno_Telefono;

            return $this;
        }

        /**
         * Get the value of turno_Celular
         */
        public function getTurnoCelular()
        {
            return $this->turno_Celular;
        }

        /**
         * Set the value of turno_Celular
         *
         *
         */
        public function setTurnoCelular($turno_Celular)
        {
            $this->turno_Celular = $turno_Celular;

            return $this;
        }

        /**
         * Get the value of turno_Email
         */
        public function getTurnoEmail()
        {
            return $this->turno_Email;
        }

        /**
         * Set the value of turno_Email
         *
         *
         */
        public function setTurnoEmail($turno_Email)
        {
            $this->turno_Email = $turno_Email;

            return $this;
        }

        /**
         * Get the value of turno_Nivel
         */
        public function getTurnoNivel()
        {
            return $this->turno_Nivel;
        }

        /**
         * Set the value of turno_Nivel
         *
         *
         */
        public function setTurnoNivel($turno_Nivel)
        {
            $this->turno_Nivel = $turno_Nivel;

            return $this;
        }

        /**
         * Get the value of turno_Municipio
         */
        public function getTurnoMunicipio()
        {
            return $this->turno_Municipio;
        }

        /**
         * Set the value of turno_Municipio
         *
         *
         */
        public function setTurnoMunicipio($turno_Municipio)
        {
            $this->turno_Municipio = $turno_Municipio;

            return $this;
        }

        /**
         * Get the value of turno_Asunto
         */
        public function getTurnoAsunto()
        {
            return $this->turno_Asunto;
        }

        /**
         * Set the value of turno_Asunto
         *
         *
         */
        public function setTurnoAsunto($turno_Asunto)
        {
            $this->turno_Asunto = $turno_Asunto;

            return $this;
        }
    } //END CLASS

} //END EXISTS
