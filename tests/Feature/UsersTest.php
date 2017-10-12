<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use QuickUser\User;
use QuickUser\Notifications\UserRegistered;

class UsersTest extends TestCase
{
  use DatabaseTransactions;
  use InteractsWithDatabase;

  public function testCanLogin()
  {
    $user = factory(User::class)->create();
    $response = $this->post('/login', [
      'email'=> $user->email,
      'password' => 'secret'
    ]);

    $this->assertAuthenticatedAs($user);
  }

  public function testCanUserRegister()
  {
    $response = $this->post('/register', [
      'name' => 'Jonatan Bonilla',
      'phone_number' => '123456789',
      'email' => 'prueba@example.com',
      'password' => bcrypt('secret'),
      'role_id' => 3
    ]);

    $response->assertRedirect('/');
  }

  public function testCanSeeUserProfile()
  {
    $user = factory(User::class)->create();
    $this->post('/login', [
      'email'=> $user->email,
      'password' => 'secret'
    ]);
    $response = $this->get('/usuarios/'.$user->id.'/perfil');

    $response->assertSee($user->name);
    $response->assertViewIs('users.edit');
  }

  public function testCanAdminDeleteUser()
  {
    $admin = User::create([
      'name' => 'Jonatan Bonilla',
      'phone_number' => '123456789',
      'email' => 'prueba@example.com',
      'password' => bcrypt('secret'),
      'role_id' => 1,
      'active' => 1
    ]);
    $user = factory(User::class)->create();

    $response = $this->actingAs($admin)->delete('/usuarios/'.$user->id.'/borrar');

    $response->assertRedirect('/usuarios/');
  }

  public function testUserCanBeNotified()
  {
    Notification::fake();
    $user = User::create([
      'name' => 'Jonatan Bonilla',
      'phone_number' => '123456789',
      'email' => 'prueba@example.com',
      'password' => bcrypt('secret'),
      'role_id' => 3,
      'active' => 1,
      'email_verification_token' => str_random(60)
    ]);

    Notification::assertNotSentTo([$user], UserRegistered::class);
  }
}
