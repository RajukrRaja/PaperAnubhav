<?php
namespace Tests\Feature; use Illuminate\Foundation\Testing\RefreshDatabase; use Tests\TestCase;
class RegistrationTest extends TestCase {use RefreshDatabase; public function test_user_can_register():void{$response=$this->post('/register',['name'=>'Test Candidate','username'=>'test-candidate','email'=>'candidate@example.com','password'=>'SecurePass123','password_confirmation'=>'SecurePass123']);$response->assertRedirect('/dashboard');$this->assertAuthenticated();$this->assertDatabaseHas('users',['email'=>'candidate@example.com']);}}
