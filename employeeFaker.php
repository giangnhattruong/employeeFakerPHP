<?php
require 'vendor/autoload.php';
// require_once '/path/to/Faker/src/autoload.php';

use Carbon\Carbon;

const ONE_HUNDRED_PERCENT = 100;

// Get faker
$faker = Faker\Factory::create('ja_JP');

// Get serializer
$serializer = JMS\Serializer\SerializerBuilder::create()->build();

class People {
    private string $fullName;
    private string $gender;
    private string $birthDate;
    private string $department;

    public function __construct(
        $fullName,
        $gender,
        $birthDate,
        $department
    ) {
        $this->setFullName($fullName);
        $this->setGender($gender);
        $this->setBirthDate($birthDate);
        $this->setDepartment($department);
    }

    /**
     * Get the value of fullName
     */ 
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set the value of fullName
     *
     * @return  self
     */ 
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of birthDate
     */ 
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set the value of birthDate
     *
     * @return  self
     */ 
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get the value of department
     */ 
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set the value of department
     *
     * @return  self
     */ 
    public function setDepartment($department)
    {
        $this->department = $department;
        return $this;
    }

    public function getLineData() {
        return $this->fullName
            .","
            .$this->gender
            .","
            .$this->birthDate
            .","
            .$this->department;
    }
}

class Department {
    private const ONE_HUNDRED_PERCENT = 100;
    private string $name;
    private ?int $groupAProp;
    private ?int $groupBProp;
    private ?int $groupCProp;
    private ?int $groupDProp;
    private ?int $groupEProp;
    private ?int $count;

    public function __construct(
        string $name, ?int $groupAProp = 0, ?int $groupBProp = 0, 
        ?int $groupCProp = 0, ?int $groupDProp = 0, ?int $groupEProp = 0, ?int $count = 0
    ) {
        $this->setName($name);
        $this->setGroupAProp($groupAProp);
        $this->setGroupBProp($groupBProp);
        $this->setGroupCProp($groupCProp);
        $this->setGroupDProp($groupDProp);
        $this->setGroupEProp($groupEProp);
        $this->setCount($count);
    }

    /**
     * Validate probability
     *
     * @return void
     */
    public function validateProps() {
        return array_sum([
            $this->groupAProp,
            $this->groupBProp,
            $this->groupCProp,
            $this->groupDProp,
            $this->groupEProp
        ]) == 100;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of groupAProp
     */ 
    public function getGroupAProp()
    {
        return $this->groupAProp;
    }

    /**
     * Set the value of groupAProp
     *
     * @return  self
     */ 
    public function setGroupAProp($groupAProp)
    {
        $this->groupAProp = $groupAProp;

        return $this;
    }

    /**
     * Get the value of groupBProp
     */ 
    public function getGroupBProp()
    {
        return $this->groupBProp;
    }

    /**
     * Set the value of groupBProp
     *
     * @return  self
     */ 
    public function setGroupBProp($groupBProp)
    {
        $this->groupBProp = $groupBProp;

        return $this;
    }

    /**
     * Get the value of groupCProp
     */ 
    public function getGroupCProp()
    {
        return $this->groupCProp;
    }

    /**
     * Set the value of groupCProp
     *
     * @return  self
     */ 
    public function setGroupCProp($groupCProp)
    {
        $this->groupCProp = $groupCProp;

        return $this;
    }

    /**
     * Get the value of groupDProp
     */ 
    public function getGroupDProp()
    {
        return $this->groupDProp;
    }

    /**
     * Set the value of groupDProp
     *
     * @return  self
     */ 
    public function setGroupDProp($groupDProp)
    {
        $this->groupDProp = $groupDProp;

        return $this;
    }

    /**
     * Get the value of groupEProp
     */ 
    public function getGroupEProp()
    {
        return $this->groupEProp;
    }

    /**
     * Set the value of groupEProp
     *
     * @return  self
     */ 
    public function setGroupEProp($groupEProp)
    {
        $this->groupEProp = $groupEProp;

        return $this;
    }

    /**
     * Get the value of count
     */ 
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set the value of count
     *
     * @return  self
     */ 
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get the value of groupACount
     */ 
    public function getGroupACount()
    {
        return $this->getCountFromProp($this->count, $this->groupAProp);
    }

    /**
     * Get the value of groupBCount
     */ 
    public function getGroupBCount()
    {
        return $this->getCountFromProp($this->count, $this->groupBProp);
    }

    /**
     * Get the value of groupCCount
     */ 
    public function getGroupCCount()
    {
        return $this->getCountFromProp($this->count, $this->groupCProp);
    }

    /**
     * Get the value of groupDCount
     */ 
    public function getGroupDCount()
    {
        return $this->getCountFromProp($this->count, $this->groupDProp);
    }

    /**
     * Get the value of groupECount
     */ 
    public function getGroupECount()
    {
        return $this->count - array_sum([
            $this->getGroupACount(),
            $this->getGroupBCount(),
            $this->getGroupCCount(),
            $this->getGroupDCount(),
        ]);
    }

    /**
     * Count from probability
     *
     * @param [type] $total
     * @param [type] $prop
     * @return void
     */
    private function getCountFromProp($total, $prop) {
        return (int) round($total * $prop / self::ONE_HUNDRED_PERCENT);
    }
}

class Organization {
    private string $name;
    private array $departments = [];
    private array $deptProps = [];
    private ?int $totalEmployee;

    public function __construct(
        string $name, 
        ?array $departments = [],
        ?array $deptProps = [],
        ?int $totalEmployee = 0
    ) {
        $this->setName($name);
        $this->setDepartments($departments);
        $this->setDeptProps($deptProps);
        $this->setTotalEmployee($totalEmployee);
    }

    public function validateProps() {
        return array_sum($this->deptProps) == 100 &&
            count($this->deptProps) == count($this->departments);
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of departments
     */ 
    public function getDepartments()
    {
        return $this->departments;
    }

    /**
     * Set the value of departments
     *
     * @return  self
     */ 
    public function setDepartments($departments)
    {
        $this->departments = $departments;

        return $this;
    }

    /**
     * Get the value of deptProps
     */ 
    public function getDeptProps()
    {
        return $this->deptProps;
    }

    /**
     * Set the value of deptProps
     *
     * @return  self
     */ 
    public function setDeptProps($deptProps)
    {
        $this->deptProps = $deptProps;

        return $this;
    }

    /**
     * Get the value of totalEmployee
     */ 
    public function getTotalEmployee()
    {
        return $this->totalEmployee;
    }

    /**
     * Set the value of totalEmployee
     *
     * @return  self
     */ 
    public function setTotalEmployee($totalEmployee)
    {
        $this->totalEmployee = $totalEmployee;

        return $this;
    }
}

function generateRandomPeopleInOrganization(Organization $organization) {
    // Get departments
    $departments = $organization->getDepartments();
    // Get departments' probabilities
    $deptProps = $organization->getDeptProps();
    // Get total employees
    $totalEmployees = $organization->getTotalEmployee();
    // Validate organization input
    if (!$organization->validateProps()) {
        // echo('Invalid organization input!');
        // return [];
        throw new InvalidArgumentException('Invalid organization input!');
    }
    // Validate department probabilities
    foreach ($departments as $dept) {
        if (!$dept->validateProps()) {
            // echo('Invalid department '.$dept->getName().' probabilities!');
            // return [];
            throw new InvalidArgumentException('Invalid department '.$dept->getName().' probabilities!');
        }
    }
    // Set department counts
    setDeptCounts($totalEmployees, $departments, $deptProps);
    // Generate random people in each group
    $people = generateRandomPeopleInDepartments($departments);
    return $people;
}

function setDeptCounts(int $totalEmployees, array $departments, array $deptProps) {
    $departmentCounts = 0;
    foreach ($departments as $i => $dept) {
        // Set remaining employee counts to last department
        if ($i == count($departments) - 1) {
            $dept->setCount($totalEmployees - $departmentCounts);
            break;
        }
        // Set employee counts to each department
        $deptCounts = countFromProbability($totalEmployees, $deptProps[$i]);
        $dept->setCount($deptCounts);
        $departmentCounts += $deptCounts;
    }
}

function generateRandomPeopleInDepartments(array $departments) {
    $people = [];
    foreach ($departments as $dept) {
        $deptPeople = generateRandomPeopleInAgeGroups($dept);
        $people = $people ?
            [
                ...$people,
                ...$deptPeople
            ] :
            $deptPeople;
    }
    return $people;
}

function countFromProbability(int $total, int $propbability) {
    return (int)round($total * $propbability / ONE_HUNDRED_PERCENT);
}

/**
 * Group A: 20-29
 * Group B: 30-39
 * Group C: 40-49
 * Group D: 50-59
 * Group E: 60-69
 */
function generateRandomPeopleInAgeGroups(Department $department) {
    try {
        // Generate random people in each group
        $groupAPeople = generateRandomPeople($department->getGroupACount(), 20, 29, $department->getName());
        $groupBPeople = generateRandomPeople($department->getGroupBCount(), 30, 39, $department->getName());
        $groupCPeople = generateRandomPeople($department->getGroupCCount(), 40, 49, $department->getName());
        $groupDPeople = generateRandomPeople($department->getGroupDCount(), 50, 59, $department->getName());
        $groupEPeople = generateRandomPeople($department->getGroupECount(), 60, 69, $department->getName());
        $people = [
            ...$groupAPeople,
            ...$groupBPeople,
            ...$groupCPeople,
            ...$groupDPeople,
            ...$groupEPeople,
        ];
        return $people;
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

function generateRandomPeople(int $count, int $minAge, int $maxAge, string $departmentName) {
    global $faker;
    $people = [];
    for ($i=0; $i < $count; $i++) { 
        // Generate random gender
        $genders = ['male', 'female'];
        $randGenderIndex = mt_rand(0, 1);
        $gender = $genders[$randGenderIndex];
        // Generate random birth date
        $birthDate = $faker->dateTimeBetween('-'.$maxAge.' years', '-'.$minAge.' years')->format('Y-m-d');
        // Generate random name
        $fullName = $faker->kanaName($gender);
        $people[] = new People($fullName, $gender, $birthDate, $departmentName);
    }
    return $people;
}

function callAPI($method, $url, $data = false)
{
    $curl = curl_init();
    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

function exportCsv($data, $fileName) {
    $fp = fopen($fileName, 'w');
    foreach ($data as $line) {
        fputcsv($fp, explode(",", $line));
    }
    fclose($fp);
}

$departments = [
    new Department("BIM", 35, 15, 20, 10, 20),
    new Department("IT", 25, 10, 15, 20, 30),
    new Department("Design", 10, 15, 20, 25, 30),
    new Department("Management", 15, 30, 40, 10, 5),
    new Department("Sale", 15, 15, 20, 30, 20)
];
$deptProps = [25, 35, 20, 5, 15];
$organization = new Organization("ABC-const", $departments, $deptProps, 300);

try {
    $randomEmployees = generateRandomPeopleInOrganization($organization);
    // $data = $serializer->serialize($randomEmployees, 'json');
    // $decode = json_decode($data, true);
    // var_dump($data);
    $lines = [];
    foreach ($randomEmployees as $employee) {
        $lines[] = $employee->getLineData();
    }
    exportCsv($lines, "newData.csv");
    var_dump($lines);
} catch (InvalidArgumentException $ex) {
    echo($ex->getMessage());
}

// $limelight = new Limelight\Limelight();
// $results = $limelight->parse('庭でライムを育てています。');
// echo 'Romaji: ' . $results->string('romaji', ' ') . "\n";

// Read & write data
// $handle = fopen("data.txt", "r");
// $lines = [];
// if (($handle = fopen("data.txt", "r")) !== FALSE) {
//     while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
//         // var_dump($data[0]);
//         $lines[] = $data[0];
//     }
//     fclose($handle);
// }
// $fp = fopen('data.csv', 'w');
// foreach ($lines as $line) {
//     fputcsv($fp, explode(",", $line));
// }
// fclose($fp);
