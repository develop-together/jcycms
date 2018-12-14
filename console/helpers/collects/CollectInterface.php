<?php 
namespace console\helpers\collects;

interface CollectInterface
{
	public function getTotalPage($html);

	public function getListUrl($html);

	public function getArticle($html);
}