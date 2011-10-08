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

require_once dirname(__FILE__) . '/../Qyy_G_en_File.php';

/**
 * Test class for Qyy_G_en_File.
 */
class Qyy_G_en_FileTest extends PHPUnit_Framework_TestCase
{

  /**
   * @var Qyy_G_en_File
   */
  protected $object0;

  /**
   * @var Qyy_G_en_File
   */
  protected $object1;
  
  /**
   * @var Qyy_G_en_File
   */
  protected $object2;
  
  /**
   * @var Qyy_G_en_File
   */
  protected $object3;
  
  /**
   * @var Qyy_G_en_File
   */
  protected $object4;
  
  /**
   * @var array
   */
  protected $filenames;
  
  /**
   * @var string
   */
  protected $data;
  
  /**
   * Sets up the fixture.
   */
  protected function setUp()
  {
    // if it's >= 10, the instantiation of the class will throw an excpetion
    $this->filenames = array(
       0 => '../readme.md',
       1 => '../.gitignore',
       2 => '../README',
       3 => '../temp/overwrite.tmp',
       4 => '../temp/new.tmp',
      10 => 'foo.bar',
      11 => '../temp/test.tmp',
      12 => '../temp/foo/new.tmp');
    
    $this->data = strval(time());
    
    $this->testNewObject0();
    $this->testNewObject1();
    $this->testNewObject2();
    $this->testNewObject3();
    $this->testNewObject4();
  }

 /**
  * Tears down the fixture.
  */
 protected function tearDown ()
 {
   // I reset the content of this file with its value when commited for the
   // first time. So I don't have to see it in the list of modified files to
   // commit.
   file_put_contents($this->filenames[3], '1318067799');
   
   unlink($this->filenames[4]);
 }

  public function testNewObject0 ()
  {
    $this->object0 = new Qyy_G_en_File($this->filenames[0]);
    
    $this->assertEquals(true, is_a($this->object0, 'Qyy_G_en_File'));
  }
  
  public function testNewObject1 ()
  {
    $this->object1 = new Qyy_G_en_File($this->filenames[1]);
    
    $this->assertEquals(true, is_a($this->object1, 'Qyy_G_en_File'));
  }

  public function testNewObject2 ()
  {
    $this->object2 = new Qyy_G_en_File($this->filenames[2]);
    
    $this->assertEquals(true, is_a($this->object2, 'Qyy_G_en_File'));
  }
  
  public function testNewObject3 ()
  { 
    $this->object3 =
      new Qyy_G_en_File(
        $this->filenames[3],
        $this->data,
        true);
    
    $this->assertEquals(true, is_a($this->object3, 'Qyy_G_en_File'));
  }
  
  public function testNewObject4 ()
  { 
    $this->object4 =
      new Qyy_G_en_File(
        $this->filenames[4],
        $this->data,
        true);
    
    $this->assertEquals(true, is_a($this->object4, 'Qyy_G_en_File'));
  }

  /**
   * @expectedException InvalidArgumentException
   */
  public function testNewObject10 ()
  {
    new Qyy_G_en_File($this->filenames[10]);
  }
  
  /**
   * @expectedException OverflowException
   */
  public function testNewObject11 ()
  {
    new Qyy_G_en_File(
      $this->filenames[11],
      'testNewObject11');
  }
  
  /**
   * @expectedException Exception
   */
  public function testNewObject12 ()
  {
    new Qyy_G_en_File(
      $this->filenames[12],
      'testNewObject12');
  }
  
  /**
   * @depends testNewObject0
   * @depends testNewObject1
   * @depends testNewObject2
   * @depends testNewObject3
   * @depends testNewObject4
   */
  public function testGetFilename()
  {
    for($i = 0; $i <= 4; $i++)
    {
      $this->assertEquals(
        $this->filenames[$i],
        $this->{'object'.$i}->GetFilename());
    }
  }

  /**
   * @depends testNewObject0
   * @depends testNewObject1
   * @depends testNewObject2
   * @depends testNewObject3
   * @depends testNewObject4
   */
  public function testGetBasename()
  {
    for($i = 0; $i <= 4; $i++)
    {
      $this->assertEquals(
        basename($this->filenames[$i]),
        $this->{'object'.$i}->GetBasename());
    }
  }

  /**
   * @depends testNewObject0
   */
  public function testGetBasenameNoSuffix0 ()
  {
    $this->assertEquals('readme', $this->object0->GetBasenameNoSuffix());
  }
  
  /**
  * @depends testNewObject1
  * @expectedException LengthException
  */
  public function testGetBasenameNoSuffix1 ()
  {
    $this->object1->GetBasenameNoSuffix();
  }
  
  /**
   * @depends testNewObject2
   */
  public function testGetBasenameNoSuffix2 ()
  {
    $this->assertEquals('README', $this->object2->GetBasenameNoSuffix());
  }

  /**
   * @depends testNewObject3
   */
  public function testGetBasenameNoSuffix3 ()
  {
    $this->assertEquals('overwrite', $this->object3->GetBasenameNoSuffix());
  }
  
  /**
   * @depends testNewObject4
   */
  public function testGetBasenameNoSuffix4 ()
  {
    $this->assertEquals('new', $this->object4->GetBasenameNoSuffix());
  }

  /**
   * @depends testNewObject0
   */
  public function testGetSuffix0 ()
  {
    $this->assertEquals('md', $this->object0->GetSuffix());
  }
  
  /**
   * @depends testNewObject1
   */
  public function testGetSuffix1 ()
  {
    $this->assertEquals('gitignore', $this->object1->GetSuffix());
  }
  
  /**
   * @depends testNewObject2
   * @expectedException LengthException
   */
  public function testGetSuffix2 ()
  {
    $this->object2->GetSuffix();
  }
  
  /**
   * @depends testNewObject3
   */
  public function testGetSuffix3 ()
  {
    $this->assertEquals('tmp', $this->object3->GetSuffix());
  }

  /**
   * @depends testNewObject4
   */
  public function testGetSuffix4 ()
  {
    $this->assertEquals('tmp', $this->object4->GetSuffix());
  }

  /**
   * @depends testNewObject0
   * @depends testNewObject1
   * @depends testNewObject2
   * @depends testNewObject3
   * @depends testNewObject4
   */
  public function testGetDirname ()
  {
    for($i = 0; $i <= 4; $i++)
    {
      $this->assertEquals(
        dirname($this->filenames[$i]),
        $this->{'object'.$i}->GetDirname());
    }
  }

  /**
   * @depends testNewObject0
   * @depends testNewObject1
   * @depends testNewObject2
   * @depends testNewObject3
   * @depends testNewObject4
   */
  public function testGetRealpath ()
  {
    for($i = 0; $i <= 4; $i++)
    {
      $this->assertEquals(
        realpath($this->filenames[$i]),
        $this->{'object'.$i}->GetRealpath());
    }
  }
  
  /**
   * @depends testNewObject0
   * @depends testNewObject1
   * @depends testNewObject2
   * @depends testNewObject3
   * @depends testNewObject4
   */
  public function testGetContents ()
  {
    for($i = 0; $i <= 4; $i++)
    {
      $this->assertEquals(
        file_get_contents($this->filenames[$i]),
        $this->{'object'.$i}->GetContents());
    }
  }
  
  /**
   * @depends testNewObject3
   */
  public function testGetContents3 ()
  {
    $this->assertEquals($this->data, $this->object3->GetContents());
  }
  
  /**
   * @depends testNewObject4
   */
  public function testGetContents4 ()
  {
    $this->assertEquals($this->data, $this->object4->GetContents());
  }
}