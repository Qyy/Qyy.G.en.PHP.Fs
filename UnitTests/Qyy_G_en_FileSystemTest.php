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
 
require_once('bootstrap.php');

/**
 * Test class for Qyy_G_en_FileSystem.
 */
class Qyy_G_en_FileSystemTest extends PHPUnit_Framework_TestCase
{

  /**
   * @var array
   */
  protected $filesNames;

  /**
   * @var array
   */
  protected $fakeFilesNames;

  /**
   * @var array
   */
  protected $directoriesNames;

  /**
   * @var array
   */
  protected $fakeDirectoriesNames;

  /**
   * Sets up the fixture.
   */
  protected function setUp ()
  {
    $this->filesNames = array(
      0 => '../readme.md',
      1 => '../.gitignore',
      2 => '../README');
    
    $this->directoriesNames = array(
      0 => '../',
      1 => './');
    
    $this->fakeFilesNames = array(
      0 => 'foo.bar');
      
    $this->fakeDirectoriesNames = array(
      0 => '../foobar/');
  }
  // 
  // /**
  //  * Tears down the fixture, for example, closes a network connection.
  //  * This method is called after a test is executed.
  //  */
  // protected function tearDown ()
  // {
  //   
  // }

//---
  /*** Qyy_G_en_FileSystem::ThrowExceptionIfNodeDoesNotExists() ***/
  
  public function testThrowExceptionIfNodeDoesNotExistsFilesNames ()
  {
    foreach($this->filesNames as $name)
    {
      Qyy_G_en_FileSystem::ThrowExceptionIfNodeDoesNotExists($name);
    }
  }
  
  public function testThrowExceptionIfNodeDoesNotExistsDirectoriesNames ()
  {
    foreach($this->directoriesNames as $name)
    {
      Qyy_G_en_FileSystem::ThrowExceptionIfNodeDoesNotExists($name);
    }
  }
  
  /**
   * Nonexistent node with fake files names.
   * @expectedException InvalidArgumentException
   */
  public function testThrowExceptionIfNodeDoesNotExistsFakeFilesNames ()
  {
    foreach($this->fakeFilesNames as $name)
    {
      Qyy_G_en_FileSystem::ThrowExceptionIfNodeDoesNotExists($name);
    }
  }

  /**
   * Nonexistent node with fake directories names.
   * @expectedException InvalidArgumentException
   */
  public function testThrowExceptionIfNodeDoesNotExistsFakeDirectoriesNames ()
  {
    foreach($this->fakeDirectoriesNames as $name)
    {
      Qyy_G_en_FileSystem::ThrowExceptionIfNodeDoesNotExists($name);
    }
  }
  
  /*** END Qyy_G_en_FileSystem::ThrowExceptionIfNodeDoesNotExists() ***/
 
//---
  /*** Qyy_G_en_FileSystem::ThrowExceptionIfNodeExists() ***/
  
  /**
   * Existent file.
   * @expectedException InvalidArgumentException
   */
  public function testThrowExceptionIfNodeExistsFilesNames ()
  {
    foreach($this->filesNames as $name)
    {
      Qyy_G_en_FileSystem::ThrowExceptionIfNodeExists($name);
    }
  }
  
  /**
   * Existent directory.
   * @expectedException InvalidArgumentException
   */
  public function testThrowExceptionIfNodeExistsDirectoriesNames ()
  {
    foreach($this->directoriesNames as $name)
    {
      Qyy_G_en_FileSystem::ThrowExceptionIfNodeExists($name);
    }
  }
  
  /**
   * Nonexistent node with fake files names.
   */
  public function testThrowExceptionIfNodeExistsFakeFilesNames ()
  {
    foreach($this->fakeFilesNames as $name)
    {
      Qyy_G_en_FileSystem::ThrowExceptionIfNodeExists($name);
    }
  }

  /**
   * Nonexistent node with fake directories names.
   */
  public function testThrowExceptionIfNodeExistsFakeDirectoriesNames ()
  {
    foreach($this->fakeDirectoriesNames as $name)
    {
      Qyy_G_en_FileSystem::ThrowExceptionIfNodeExists($name);
    }
  }
  
  /*** END Qyy_G_en_FileSystem::ThrowExceptionIfNodeExists() ***/

//---
  /*** Qyy_G_en_FileSystem::ThrowExceptionIfNotFile() ***/
  
  public function testThrowExceptionIfNotFileFilesNames ()
  {
    foreach($this->filesNames as $name)
    {
      Qyy_G_en_FileSystem::ThrowExceptionIfNotFile($name);
    }
  }
  
  /**
   * It's a directory.
   * @expectedException InvalidArgumentException
   */
  public function testThrowExceptionIfNotFileDirectoriesNames ()
  {
    foreach($this->directoriesNames as $name)
    {
      Qyy_G_en_FileSystem::ThrowExceptionIfNotFile($name);
    }
  }
  
  /**
   * Nonexistent files.
   * @expectedException InvalidArgumentException
   */
  public function testThrowExceptionIfNotFileFakeFilesNames ()
  {
    foreach($this->fakeFilesNames as $name)
    {
      Qyy_G_en_FileSystem::ThrowExceptionIfNotFile($name);
    }
  }

  /**
   * Nonexistent directories.
   * @expectedException InvalidArgumentException
   */
  public function testThrowExceptionIfNotFileFakeDirectoriesNames ()
  {
    foreach($this->fakeDirectoriesNames as $name)
    {
      Qyy_G_en_FileSystem::ThrowExceptionIfNotFile($name);
    }
  }
  
  /*** END Qyy_G_en_FileSystem::ThrowExceptionIfNotFile() ***/
}