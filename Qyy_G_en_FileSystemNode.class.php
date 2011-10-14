<?php
/**
 * @author G. Qyy <pub-gh@qyy.fr>
 * @copyright Copyright (c) 2011,  G. Qyy
 * @license http://www.cecill.info/licences/Licence_CeCILL-B_V1-en.txt
 *
 * This software is a PHP set of classes whose purpose is to handle files
 * with Oriented Object paradigm. This software has only an educational aim
 * and is not to be used in a production environment.
 *
 * This software is governed by the CeCILL-B license under French law and
 * abiding by the rules of distribution of free software. You can use,
 * modify and/ or redistribute the software under the terms of the CeCILL-B
 * license as circulated by CEA, CNRS and INRIA at the following URL
 * "http://www.cecill.info".
 *
 * As a counterpart to the access to the source code and rights to copy,
 * modify and redistribute granted by the license, users are provided only
 * with a limited warranty and the software's author, the holder of the
 * economic rights, and the successive licensors have only limited liability.
 *
 * In this respect, the user's attention is drawn to the risks associated
 * with loading, using, modifying and/or developing or reproducing the
 * software by the user in light of its specific status of free software,
 * that may mean that it is complicated to manipulate, and that also
 * therefore means that it is reserved for developers and experienced
 * professionals having in-depth computer knowledge. Users are therefore
 * encouraged to load and test the software's suitability as regards their
 * requirements in conditions enabling the security of their systems and/or
 * data to be ensured and, more generally, to use and operate it in the same
 * conditions as regards security.
 *
 * The fact that you are presently reading this means that you have had
 * knowledge of the CeCILL-B license and that you accept its terms.
 */

if (!defined('QYYG_FILE_PATH'))
{
  if (
    (defined('__DIR__') && __DIR__ != dirname(__FILE__))
    || !defined('__DIR__'))
  {
    define('QYYG_FILE_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
  }
  else
  {
    define('QYYG_FILE_PATH', __DIR__.DIRECTORY_SEPARATOR);
  }
}

require_once(QYYG_FILE_PATH.'Qyy_G_en_FileSystem.class.php');

// TODO: doc
class Qyy_G_en_FileSystemNode
{
  /**
   * @var string
   */
  protected $name;
  
  // TODO: doc
  function __construct ($name)
  {
    Qyy_G_en_FileSystem::ThrowExceptionIfNodeDoesNotExists($name);

    $this->name = $name;
  }
  
  // TODO: doc
  public function GetName ()
  {
    return $this->name;
  }
  
  // TODO: doc
  // http://php.net/manual/en/function.basename.php
  public function GetBasename ()
  {
    return basename($this->GetName());
  }
  
  // TODO: doc
  // http://php.net/manual/en/function.dirname.php
  public function GetDirname ()
  {
    return dirname($this->GetName());
  }
  
  // TODO: doc
  // http://php.net/manual/en/function.realpath.php
  public function GetRealpath ()
  {
    $return = realpath($this->GetName());
    
    if ($return === false)
    {
      $lastError = error_get_last();
      
      throw new Exception(
        'Unable to determine the real path. '
          .'It might be due to a lack of permissions.',
        403,
        new Exception(
          'message: "'.$lastError['message'].'"'.PHP_EOL
            .'file: "'.$lastError['file'].'"'.PHP_EOL
            .'line: `'.$lastError['line'].'`'.PHP_EOL,
          $derniereErreur['type']));
    }
    
    return $return;
  }
}