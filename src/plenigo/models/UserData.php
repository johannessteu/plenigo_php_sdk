<?php

namespace plenigo\models;

require_once __DIR__ . '/../internal/models/Address.php';

use plenigo\internal\models\Address;

/**
 * UserData
 *
 * <p>
 * User Data model that mirrors the information provided by
 * the plenigo REST API.
 * </p>
 *
 * @category SDK
 * @package  PlenigoModels
 * @author   René Olivo <r.olivo@plenigo.com>
 * @link     https://www.plenigo.com
 */
class UserData {

    /**
     * The user id.
     */
    private $id;

    /**
     * The user's email.
     */
    private $email;

    /**
     * The user's name.
     */
    private $name;

    /**
     * The username/nickname.
     */
    private $username;

    /**
     * The user's gender.
     */
    private $gender;

    /**
     * The user's last name.
     */
    private $lastName;

    /**
     * The user's first name.
     */
    private $firstName;

    /**
     * The user's address.
     *
     * {@link \plenigo\internal\models\Address }
     */
    private $address;

    /**
     * The external user's ID.
     */
    private $externalUserId;

    /**
     * The user's birthday
     */
    private $birthday;

    /**
     * The default constructor with all required parameters.
     *
     * @param string  $id             The user's id.
     * @param string  $email          The user's email.
     * @param string  $name           The user's name.
     * @param string  $username       The username/nickname.
     * @param string  $gender         The user's gender.
     * @param string  $lastName       The user's last name.
     * @param string  $firstName      The user's first name.
     * @param Address $address        The user's address {@link \plenigo\internal\models\Address}
     * @param string  $externalUserId The external user's ID.
     * @param string  $birthday       The user's birthday.
     *
     * @return UserData instance
     */
    public function __construct($id, $email, $name, $username, $gender, $lastName, $firstName, Address $address, $externalUserId, $birthday) {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->username = $username;
        $this->gender = $gender;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->address = $address;
        $this->externalUserId = $externalUserId;
        $this->birthday = $birthday;
    }

    /**
     * Returns the user's id.
     *
     * @return string user's id.
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Returns the user's email.
     *
     * @return string user's email.
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Returns the user's name.
     *
     * @return string user's name.
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Returns the username/nickname.
     *
     * @return string username/nickname.
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Returns the user's gender.
     *
     * @return string user's gender.
     */
    public function getGender() {
        return $this->gender;
    }

    /**
     * Returns the user's last name.
     *
     * @return string user's last name.
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * Returns the user's first name.
     *
     * @return string user's first name.
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Returns the user's addres.
     *
     * @return Address user's address {@link \plenigo\internal\Address}.
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Returns the external user's ID.
     *
     * @return string user's ID.
     */
    public function getExternalUserId() {
        return $this->externalUserId;
    }

    /**
     * @return string the user's birthday
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param string $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }


    /**
     * Generates a map with the UserData properties.
     *
     * @return array UserData map.
     */
    public function getMap() {
        $map = array(
            'userId' => $this->getId(),
            'email' => $this->getEmail(),
            'name' => $this->getName(),
            'username' => $this->getUsername(),
            'gender' => $this->getGender(),
            'lastName' => $this->getLastName(),
            'firstName' => $this->getFirstName(),
            'externalUserId' => $this->getExternalUserId(),
            'birthday' => $this->getBirthday(),
        );

        $addressMap = $this->getAddress()->getMap();

        $map = array_merge($addressMap, $map);

        return $map;
    }

    /**
     * Creates a UserData instance using the provided map
     * properties.
     *
     * @param array $map The map with the properties to pass onto UserData.
     *
     * @return UserData UserData instance.
     */
    public static function createFromMap(array $map) {
        $address = Address::createFromMap($map);

        $name = isset($map['name']) ? $map['name'] : null;
        $currFirstName = isset($map['firstName']) ? $map['firstName'] : null;
        $lastName = isset($map['lastName']) ? $map['lastName'] : $name;
        $currID = isset($map['id']) ? $map['id'] : null;
        $userId = isset($map['userId']) ? $map['userId'] : $currID;
        $currEmail = isset($map['email']) ? $map['email'] : null;
        $currName = isset($map['name']) ? $map['name'] : null;
        $currUserName = isset($map['username']) ? $map['username'] : null;
        $currGender = isset($map['gender']) ? $map['gender'] : null;
        $externalUserId  = isset($map['externalUserId']) ? $map['externalUserId'] : null;
        $birthday  = isset($map['birthay']) ? $map['birthday'] : null;

        return new UserData($userId, $currEmail, $currName, $currUserName, $currGender, $lastName, $currFirstName, $address, $externalUserId, $birthday);
    }

}
