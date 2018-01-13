<?php

namespace App\Models;

/**
 * @Entity
 * @Table(name="user")
 */
class User
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * @Column(
     *     type="string",
     *     unique=true
     * )
     */
    protected $username;

    /**
     * @Column(type="string")
     */
    protected $password;

    /**
     * @Column(
     *     type="string",
     *     name="activation_token",
     *     nullable=true
     * )
     */
    protected $activationToken;

    /**
     * @Column(
     *     type="boolean",
     *     name="is_active"
     * )
     */
    protected $isActive;

    /**
     * @Column(
     *      type="string",
     *      name="access_token",
     *      nullable=true
     * )
     */
    protected $accessToken;

    /**
     * @Column(
     *     type="datetime",
     *     name="created_at",
     *     options={
     *          "default": "CURRENT_TIMESTAMP"
     *     }
     * )
     */
    protected $createdAt;

    /**
     * @Column(
     *     type="datetime",
     *     name="updated_at",
     *     options={
     *          "default": "CURRENT_TIMESTAMP"
     *     }
     * )
     */
    protected $updatedAt;

    public function getId() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getPassword() { return $this->password; }
    public function getActivationToken() { return $this->activationToken; }
    public function getIsActive() { return $this->isActive; }
    public function getAccessToken() { return $this->accessToken; }
    public function getCreatedAt() { return $this->createdAt; }
    public function getUpdatedAt() { return $this->updatedAt; }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = md5($password);
        return $this;
    }

    public function setActivationToken()
    {
        $this->activationToken = rand_str();
        return $this;
    }

    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function setAccessToken($token)
    {
        $this->accessToken = $token;
        return $this;
    }

    public function timestamp()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        return $this;
    }
}