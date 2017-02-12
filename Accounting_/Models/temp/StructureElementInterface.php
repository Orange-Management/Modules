<?php

interface StructureElementInterface {
	public function getId() : int;
	public function getName() : string;
	public function getValues() : array;
}
