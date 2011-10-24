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
 * Test class for Qyy_G_en_Fs.
 */
class Qyy_G_en_FsTest extends PHPUnit_Framework_TestCase
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
   * @var string
   */
  protected $data;
 
  /**
   * @var Qyy_G_en_Fs_File
   */
  protected $overwrittenFile;
 
  /**
   * @var Qyy_G_en_Fs_File
   */
  protected $newFile;
  
  /**
   * @var Qyy_G_en_Fs_File
   */
  protected $newFileToBeOverwrtitten;


  /**
   * Sets up the fixture.
   */
  protected function setUp ()
  {
    $this->filesNames = array(
      0 => '../readme.md',
      1 => '../.gitignore',
      2 => '../README',
      3 => '../temp/overwrite.tmp',
      4 => '../temp/new.tmp',
      5 => '../temp/newoverwrite.tmp');
    
    $this->directoriesNames = array(
      0 => '../',
      1 => './');
    
    $this->fakeFilesNames = array(
      0 => 'foo.bar');
      
    $this->fakeDirectoriesNames = array(
      0 => '../foobar/');
    
    $this->data = strval(time());
    
    $this->overwrittenFile =
      Qyy_G_en_Fs::OverwriteFile(
        $this->filesNames[3],
        $this->data.'overwrittenFile');
    
    $this->newFile =
      Qyy_G_en_Fs::CreateFile(
        $this->filesNames[4],
        $this->data.'newFile');
    
    $this->newFileToBeOverwrtitten =
      Qyy_G_en_Fs::CreateOrOverwriteFile(
        $this->filesNames[5],
        $this->data.'newFileToBeOverwrtitten');
  }

  
  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown ()
  {
    // I reset the content of this file with its value when commited for the
    // first time. So I don't have to see it in the list of modified files to
    // commit.
    file_put_contents($this->filesNames[3], '1318067799');
   
    // This file is used for the creation test without overwriting, so it's
    // important to unlink it each time after the test
    unlink('../temp/new.tmp');
    
    // This file is used for the creation and overwriting test, so it's
    // important to unlink it each time after the test
    unlink('../temp/newoverwrite.tmp');
  }

//---
  /*** Qyy_G_en_Fs::ThrowExceptionIfNodeDoesNotExists() ***/
  
  public function testThrowExceptionIfNodeDoesNotExistsFilesNames ()
  {
    foreach($this->filesNames as $name)
    {
      Qyy_G_en_Fs::ThrowExceptionIfNodeDoesNotExists($name);
    }
  }
  
  public function testThrowExceptionIfNodeDoesNotExistsDirectoriesNames ()
  {
    foreach($this->directoriesNames as $name)
    {
      Qyy_G_en_Fs::ThrowExceptionIfNodeDoesNotExists($name);
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
      Qyy_G_en_Fs::ThrowExceptionIfNodeDoesNotExists($name);
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
      Qyy_G_en_Fs::ThrowExceptionIfNodeDoesNotExists($name);
    }
  }
  
  /*** END Qyy_G_en_Fs::ThrowExceptionIfNodeDoesNotExists() ***/
 
//---
  /*** Qyy_G_en_Fs::ThrowExceptionIfNodeExists() ***/
  
  /**
   * Existent file.
   * @expectedException InvalidArgumentException
   */
  public function testThrowExceptionIfNodeExistsFilesNames ()
  {
    foreach($this->filesNames as $name)
    {
      Qyy_G_en_Fs::ThrowExceptionIfNodeExists($name);
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
      Qyy_G_en_Fs::ThrowExceptionIfNodeExists($name);
    }
  }
  
  /**
   * Nonexistent node with fake files names.
   */
  public function testThrowExceptionIfNodeExistsFakeFilesNames ()
  {
    foreach($this->fakeFilesNames as $name)
    {
      Qyy_G_en_Fs::ThrowExceptionIfNodeExists($name);
    }
  }

  /**
   * Nonexistent node with fake directories names.
   */
  public function testThrowExceptionIfNodeExistsFakeDirectoriesNames ()
  {
    foreach($this->fakeDirectoriesNames as $name)
    {
      Qyy_G_en_Fs::ThrowExceptionIfNodeExists($name);
    }
  }
  
  /*** END Qyy_G_en_Fs::ThrowExceptionIfNodeExists() ***/

//---
  /*** Qyy_G_en_Fs::ThrowExceptionIfNotFile() ***/
  
  public function testThrowExceptionIfNotFileFilesNames ()
  {
    foreach($this->filesNames as $name)
    {
      Qyy_G_en_Fs::ThrowExceptionIfNotFile($name);
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
      Qyy_G_en_Fs::ThrowExceptionIfNotFile($name);
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
      Qyy_G_en_Fs::ThrowExceptionIfNotFile($name);
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
      Qyy_G_en_Fs::ThrowExceptionIfNotFile($name);
    }
  }
  
  /*** END Qyy_G_en_Fs::ThrowExceptionIfNotFile() ***/
  
//---
  /*** Qyy_G_en_Fs::CreateOrOverwriteFile() ***/
  
  public function testCreateOrOverwriteFileCreation ()
  {
    $this->assertEquals(
      true,
      is_a($this->newFileToBeOverwrtitten, 'Qyy_G_en_Fs_File'));
  }
  
  /**
   * @depends testCreateOrOverwriteFileCreation
   */
  public function testCreateOrOverwriteFileWithGoodData ()
  {
    $this->assertEquals(
      $this->data.'newFileToBeOverwrtitten',
      $this->newFileToBeOverwrtitten->GetContents());
  }
  
  /**
   * @depends testCreateOrOverwriteFileCreation
   */
  public function testCreateOrOverwriteFileOverwriting ()
  {
    $this->newFileToBeOverwrtitten =
      Qyy_G_en_Fs::CreateOrOverwriteFile(
        $this->filesNames[5],
        $this->data.'newFileToBeOverwrtitten');
    
    $this->assertEquals(
      true,
      is_a($this->newFileToBeOverwrtitten, 'Qyy_G_en_Fs_File'));
  }

  /**
   * @depends testCreateOrOverwriteFileCreation
   */
  public function testCreateOrOverwriteFileOverwritingWithGoodData ()
  {
    $this->newFileToBeOverwrtitten =
      Qyy_G_en_Fs::CreateOrOverwriteFile(
        $this->filesNames[5],
        $this->data.'CRUSH');
    
    $this->assertEquals(
      $this->data.'CRUSH',
      $this->newFileToBeOverwrtitten->GetContents());
  }
  
  /*** END Qyy_G_en_Fs::CreateOrOverwriteFile() ***/

//---
  /*** Qyy_G_en_Fs::CreateFile() ***/
  
  public function testCreateFile ()
  {
    $this->assertEquals(
      true,
      is_a($this->newFile, 'Qyy_G_en_Fs_File'));
  }
  
  /**
   * @depends testCreateFile
   */
  public function testCreatedFileWithGoodData ()
  {
    $this->assertEquals(
      $this->data.'newFile',
      $this->newFile->GetContents());
  }
  
  /**
   * Attempting to create a file who already exists.
   * @expectedException InvalidArgumentException
   */
  public function testCreateFileWithOverwrite ()
  {
    Qyy_G_en_Fs::CreateFile(
      $this->filesNames[3],
      'testCreateFileWithOverwrite');
  }
  
  /*** END Qyy_G_en_Fs::CreateFile() ***/

//---
  /*** Qyy_G_en_Fs::OverwriteFile() ***/
  
  public function testOverwriteFile ()
  {
    $this->assertEquals(
      true,
      is_a($this->overwrittenFile, 'Qyy_G_en_Fs_File'));
  }
  
  /**
   * @depends testOverwriteFile
   */
  public function testOverwriteFileGoodData ()
  {
    $this->assertEquals(
      $this->data.'overwrittenFile',
      $this->overwrittenFile->GetContents());
  }
  
  /**
   * Attempting to create a file who already exists.
   * @expectedException InvalidArgumentException
   */
  public function testOverwriteFileWithNonExistentFile ()
  {
    Qyy_G_en_Fs::OverwriteFile(
      $this->fakeFilesNames[0],
      'testOverwriteFileWithNonExistentFile');
  }
  
  /*** END Qyy_G_en_Fs::OverwriteFile() ***/
}