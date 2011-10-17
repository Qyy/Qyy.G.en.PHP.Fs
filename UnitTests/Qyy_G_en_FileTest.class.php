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
 * Test class for Qyy_G_en_File.
 */
class Qyy_G_en_FileTest extends PHPUnit_Framework_TestCase
{

  /**
   * @var string
   */
  protected $data;
  
  /**
   * @var array
   */
  protected $names;

  /**
   * @var array
   */
  protected $fakeNames;

  /**
   * @var array
   */
  protected $directoriesNames;

  /**
   * Sets up the fixture.
   */
  protected function setUp()
  {
    $this->names = array(
      0 => '../readme.md',
      1 => '../.gitignore',
      2 => '../README',
      3 => '../temp/overwrite.tmp',
      4 => '../temp/new.tmp');
    
    $this->fakeNames = array(
      0 => 'foo.bar',
      1 => '../temp/test.tmp',
      2 => '../temp/foo/new.tmp');
      
    $this->directoriesNames = array(
      0 => './',
      1 => '../',
      2 => '../temp/',
      3 => '../temp');
    
    $this->data = strval(time());
    
    $this->objects[0] = new Qyy_G_en_File($this->names[0]);
    $this->objects[1] = new Qyy_G_en_File($this->names[1]);
    $this->objects[2] = new Qyy_G_en_File($this->names[2]);
    
    $this->objects[3] =
      new Qyy_G_en_File(
        $this->names[3],
        $this->data,
        true);
    
    $this->objects[4] =
      new Qyy_G_en_File(
        $this->names[4],
        $this->data);
  }

  /**
   * Tears down the fixture.
   */
  protected function tearDown ()
  {
    // I reset the content of this file with its value when commited for the
    // first time. So I don't have to see it in the list of modified files to
    // commit.
    file_put_contents($this->names[3], '1318067799');
   
    unlink($this->names[4]);
  }

  public function testNewObject ()
  {
    foreach($this->objects as $object)
    {
      $this->assertEquals(
        true,
        is_a($object, 'Qyy_G_en_File'));
    }
  }
 
  /**
   * This is a directory.
   * @expectedException InvalidArgumentException
   */
  public function testDirectoriesNames ()
  {
    foreach($this->directoriesNames as $name)
    {
      new Qyy_G_en_File($name);
    }
  }

  /**
   * Nonexistent file.
   * @expectedException InvalidArgumentException
   */
  public function testNewFakeObject0 ()
  {
    new Qyy_G_en_File($this->fakeNames[0]);
  }
  
  /**
   * Existing file, but overwriting parameter set to default (`false`).
   * @expectedException OverflowException
   */
  public function testNewFakeObject1 ()
  {
    new Qyy_G_en_File(
      $this->fakeNames[1],
      'testNewObject1');
  }
  
  /**
   * Unable to create the file.
   * @expectedException Exception
   */
  public function testNewFakeObject2 ()
  {
    new Qyy_G_en_File(
      $this->fakeNames[2],
      'testNewObject2');
  }

//---
  /*** Qyy_G_en_File::GetBasenameNoSuffix() ***/

  /**
   * @depends testNewObject
   */
  public function testGetBasenameNoSuffix0 ()
  {
    $this->assertEquals('readme', $this->objects[0]->GetBasenameNoSuffix());
  }
  
  /**
  * @depends testNewObject
  * @expectedException LengthException
  */
  public function testGetBasenameNoSuffix1 ()
  {
    $this->objects[1]->GetBasenameNoSuffix();
  }
  
  /**
   * @depends testNewObject
   */
  public function testGetBasenameNoSuffix2 ()
  {
    $this->assertEquals('README', $this->objects[2]->GetBasenameNoSuffix());
  }

  /**
   * @depends testNewObject
   */
  public function testGetBasenameNoSuffix3 ()
  {
    $this->assertEquals(
      'overwrite',
      $this->objects[3]->GetBasenameNoSuffix());
  }
  
  /**
   * @depends testNewObject
   */
  public function testGetBasenameNoSuffix4 ()
  {
    $this->assertEquals('new', $this->objects[4]->GetBasenameNoSuffix());
  }

  /*** END Qyy_G_en_File::GetBasenameNoSuffix() ***/
  
//---  
  /*** Qyy_G_en_File::GetSuffix() ***/

  /**
   * @depends testNewObject
   */
  public function testGetSuffix0 ()
  {
    $this->assertEquals('md', $this->objects[0]->GetSuffix());
  }
  
  /**
   * @depends testNewObject
   */
  public function testGetSuffix1 ()
  {
    $this->assertEquals('gitignore', $this->objects[1]->GetSuffix());
  }
  
  /**
   * @depends testNewObject
   * @expectedException LengthException
   */
  public function testGetSuffix2 ()
  {
    $this->objects[2]->GetSuffix();
  }
  
  /**
   * @depends testNewObject
   */
  public function testGetSuffix3 ()
  {
    $this->assertEquals('tmp', $this->objects[3]->GetSuffix());
  }

  /**
   * @depends testNewObject
   */
  public function testGetSuffix4 ()
  {
    $this->assertEquals('tmp', $this->objects[4]->GetSuffix());
  }
  
  /*** END Qyy_G_en_File::GetSuffix() ***/
  
//---
  /*** Qyy_G_en_File::GetDirname() ***/

  /**
   * @depends testNewObject
   */
  public function testGetDirname ()
  {
    foreach($this->names as $i => $name)
    {
      $this->assertEquals(
        dirname($name),
        $this->objects[$i]->GetDirname());
    }
  }
  
  /*** END Qyy_G_en_File::GetDirname() ***/

//---
  /*** Qyy_G_en_File::GetRealpath() ***/
  
  /**
   * @depends testNewObject
   */
  public function testGetRealpath ()
  {
    foreach($this->names as $i => $name)
    {
      $this->assertEquals(
        realpath($name),
        $this->objects[$i]->GetRealpath());
    }
  }
  
  /*** END Qyy_G_en_File::GetRealpath() ***/
  
//---
  /*** Qyy_G_en_File::GetContents() ***/
  
  /**
   * @depends testNewObject
   */
  public function testGetContents ()
  {
    foreach($this->names as $i => $name)
    {
      $this->assertEquals(
        file_get_contents($name),
        $this->objects[$i]->GetContents());
    }
  }
  
  /**
   * @depends testNewObject
   */
  public function testGetContents3 ()
  {
    $this->assertEquals($this->data, $this->objects[3]->GetContents());
  }
  
  /**
   * @depends testNewObject
   */
  public function testGetContents4 ()
  {
    $this->assertEquals($this->data, $this->objects[4]->GetContents());
  }
  
  /*** END Qyy_G_en_File::GetContents() ***/
}