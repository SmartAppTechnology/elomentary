<?php

/**
 * @file
 * Contains \Eloqua\Tests\Api\Assets\EmailTest.
 */

namespace Eloqua\Tests\Api\Assets;

use Eloqua\Tests\Api\TestCase;

class EmailTest extends TestCase {

  /**
   * @test
   */
  public function shouldSearchEmails() {
    $term = 'Never Gonna Give*';
    $expected_response = array('response');

    $api = $this->getApiMock();
    $api->expects($this->once())
      ->method('get')
      ->with('assets/emails', array('search' => $term))
      ->will($this->returnValue($expected_response));

    $this->assertEquals($expected_response, $api->search($term));
  }

  /**
   * @test
   */
  public function shouldSearchEmailsWithOptions() {
    $term = 'Never Gonna Give*';
    $options = array('count' => 5);
    $expected_response = array('response');

    $api = $this->getApiMock();
    $api->expects($this->once())
      ->method('get')
      ->with('assets/emails', array_merge(array('search' => $term), $options))
      ->will($this->returnValue($expected_response));

    $this->assertEquals($expected_response, $api->search($term, $options));
  }

  /**
   * @test
   */
  public function shouldGetGroups() {
    $api = $this->getApiMock();
    $this->assertInstanceOf('Eloqua\Api\Assets\Email\Group', $api->groups());
  }

  /**
   * @test
   */
  public function shouldGetFolders() {
    $api = $this->getApiMock();
    $this->assertInstanceOf('Eloqua\Api\Assets\Email\Folder', $api->folders());
  }

  /**
   * @test
   */
  public function shouldGetFooters() {
    $api = $this->getApiMock();
    $this->assertInstanceOf('Eloqua\Api\Assets\Email\Footer', $api->footers());
  }

  /**
   * @test
   */
  public function shouldGetDeployments() {
    $api = $this->getApiMock();
    $this->assertInstanceOf('Eloqua\Api\Assets\Email\Deployment', $api->deployments());
  }

  /**
   * @test
   */
  public function shouldGetHeaders() {
    $api = $this->getApiMock();
    $this->assertInstanceOf('Eloqua\Api\Assets\Email\Header', $api->headers());
  }

  /**
   * @test
   */
  public function shouldShowEmailJustId() {
    $id = 1337;
    $expected_response = array('response');

    $api = $this->getApiMock();
    $api->expects($this->once())
      ->method('get')
      ->with('assets/email/' . $id)
      ->will($this->returnValue($expected_response));

    $this->assertEquals($expected_response, $api->show($id));
  }

  /**
   * @test
   */
  public function shouldShowEmailWithDepth() {
    $email_id = 1337;
    $email_depth = 'complete';
    $expected_response = array('response');

    $api = $this->getApiMock();
    $api->expects($this->once())
      ->method('get')
      ->with('assets/email/' . $email_id, array(
        'depth' => $email_depth,
        'extensions' => null,
      ))
      ->will($this->returnValue($expected_response));

    $this->assertEquals($expected_response, $api->show($email_id, $email_depth));
  }

  /**
   * @test
   */
  public function shouldShowEmailWithExtensions() {
    $email_id = 1337;
    $email_depth = 'complete';
    $email_extensions = 'extension123';
    $expected_response = array('response');

    $api = $this->getApiMock();
    $api->expects($this->once())
      ->method('get')
      ->with('assets/email/' . $email_id, array(
        'depth' => $email_depth,
        'extensions' => $email_extensions,
      ))
      ->will($this->returnValue($expected_response));

    $this->assertEquals($expected_response, $api->show($email_id, $email_depth, $email_extensions));
  }
  /**
   * @test
   */
  public function shouldCreateEmail() {
    $name = 'Elomentary Test Email';
    $options = array(
      'folderId' => 42,
      'emailGroupId' => 420,
      'subject' => 'Test Subject',
    );
    $expected_response = array('response');

    $api = $this->getApiMock();
    $api->expects($this->once())
      ->method('post')
      ->with('assets/email', array_merge(array('name' => $name), $options))
      ->will($this->returnValue($expected_response));

    $this->assertEquals($expected_response, $api->create($name, $options));
  }

  /**
   * @test
   */
  public function shouldUpdateEmail() {
    $email_id = 123;
    $email_data = array(
      'folderId' => 456,
      'emailGroupId' => 789,
      'subject' => 'Test Subject',
    );
    $expected_response = array('response');

    $api = $this->getApiMock();
    $api->expects($this->once())
      ->method('put')
      ->with('assets/email/' . $email_id, $email_data)
      ->will($this->returnValue($expected_response));

    $this->assertEquals($expected_response, $api->update($email_id, $email_data));
  }

  /**
   * @test
   * @expectedException InvalidArgumentException
   */
  public function shouldThrowExceptionWhenCreatingEmailWithMissingParams() {
    $name = 'Elomentary, My Dear Watson';
    $options = array('folderId' => 42);

    $api = $this->getApiMock();
    $api->expects($this->any())
      ->method('post');

    $api->create($name, $options);
  }

  /**
   * @test
   */
  public function shouldRemoveEmail() {
    $email_id = 1337;
    $expected_response = array('response');

    $api = $this->getApiMock();
    $api->expects($this->once())
      ->method('delete')
      ->with('assets/email/' . $email_id)
      ->will($this->returnValue($expected_response));
    $this->assertEquals($expected_response, $api->remove($email_id));
  }

  /**
   * @test
   * @expectedException InvalidArgumentException
   */
  public function shouldThrowExceptionWithBadId() {
    $api = $this->getApiMock();
    $api->expects($this->any())
      ->method('delete');

    $api->remove('x404');
  }

  protected function getApiClass() {
    return 'Eloqua\Api\Assets\Email';
  }

}
