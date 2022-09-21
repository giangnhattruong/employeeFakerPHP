<?php
require 'vendor/autoload.php';
// require_once '/path/to/Faker/src/autoload.php';

use Carbon\Carbon;

const ONE_HUNDRED_PERCENT = 100;
const DEPT_SALE = '営業';
const DEPT_MANAGEMENT = '管理';
const DEPT_DEVELOPMENT = '開発';
const DEPT_CONSTRUCTION = '建設';
const DEPT_DESIGN = '設計';
const TITLE_BUCHOU = '部長';
const TITLE_KACHOU = '課長';
const TITLE_KEICHOU = '係長';
const TITLE_SHUNIN = '主任';
const TITLE_OTHERS = '社員';
const AGE_A = '20-29';
const AGE_B = '30-39';
const AGE_C = '40-49';
const AGE_D = '50-59';
const AGE_E = '60-69';
const ROLE_CHIEF_COUNTS = [
    DEPT_SALE => [
        TITLE_BUCHOU => 1,
        TITLE_KACHOU => 1,
        TITLE_KEICHOU => 2,
        TITLE_SHUNIN => 5
    ],
    DEPT_MANAGEMENT => [
        TITLE_BUCHOU => 1,
        TITLE_KACHOU => 2,
        TITLE_KEICHOU => 3,
        TITLE_SHUNIN => 5
    ],
    DEPT_DEVELOPMENT => [
        TITLE_BUCHOU => 1,
        TITLE_KACHOU => 1,
        TITLE_KEICHOU => 2,
        TITLE_SHUNIN => 5
    ],
    DEPT_CONSTRUCTION => [
        TITLE_BUCHOU => 1,
        TITLE_KACHOU => 2,
        TITLE_KEICHOU => 5,
        TITLE_SHUNIN => 5
    ],
    DEPT_DESIGN => [
        TITLE_BUCHOU => 1,
        TITLE_KACHOU => 1,
        TITLE_KEICHOU => 2,
        TITLE_SHUNIN => 5
    ]
];

function getTotalChiefCounts($dept) {
    $count = 0;
    foreach ($dept as $key => $value) {
        $count += $value;
    }
    return $count;
}
// Get faker
$faker = Faker\Factory::create('ja_JP');

// Get serializer
$serializer = JMS\Serializer\SerializerBuilder::create()->build();


class People {
    private string $fullName;
    private string $gender;
    private int $age;
    private string $title;
    private ?string $department = null;

    public function __construct(
        $fullName,
        $gender,
        $age,
        $title,
        $department = null
    ) {
        $this->setFullName($fullName);
        $this->setGender($gender);
        $this->setAge($age);
        $this->setTitle($title);
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
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    
    /**
     * Get the value of age
     */ 
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of age
     *
     * @return  self
     */ 
    public function setAge($age)
    {
        $this->age = $age;
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
            .$this->age
            .","
            .$this->department
            .","
            .$this->title;
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
 * Generate department people
 * Group A: 20-29
 * Group B: 30-39
 * Group C: 40-49
 * Group D: 50-59
 * Group E: 60-69
 */
function generateRandomPeopleInAgeGroups(Department $department) {
    try {
        // Generate random people in each group
        $groupAPeople = generateRandomPeople($department->getGroupACount(), 20, 29, TITLE_OTHERS, $department->getName());
        $groupBPeople = generateRandomPeople($department->getGroupBCount(), 30, 39, TITLE_OTHERS, $department->getName());
        $groupCPeople = generateRandomPeople($department->getGroupCCount(), 40, 49, TITLE_OTHERS, $department->getName());
        $groupDPeople = generateRandomPeople($department->getGroupDCount(), 50, 59, TITLE_OTHERS, $department->getName());
        $groupEPeople = generateRandomPeople($department->getGroupECount(), 60, 69, TITLE_OTHERS, $department->getName());
        $people = [
            ...$groupAPeople,
            ...$groupBPeople,
            ...$groupCPeople,
            ...$groupDPeople,
            ...$groupEPeople,
        ];
        // From random data, raise(make) chiefs
        $people = makeAllChiefs($department, $people);
        return $people;
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

/**
 * Make department chiefs
 *
 * @param [type] $department
 * @param [type] $currentPeople
 * @return void
 */
function makeAllChiefs($department, $currentPeople) {
    $deptName = $department->getName();
    $deptRoleChiefCounts = ROLE_CHIEF_COUNTS[$deptName];
    $buchouCount = $deptRoleChiefCounts[TITLE_BUCHOU];
    $kachouCount = $deptRoleChiefCounts[TITLE_KACHOU];
    $keichouCount = $deptRoleChiefCounts[TITLE_KEICHOU];
    $shuninCount = $deptRoleChiefCounts[TITLE_SHUNIN];
    $createFromIndex = 0;
    $createdIndexes = [];
    $rs = makeOneTitleChiefs($buchouCount, TITLE_BUCHOU, $currentPeople, $createdIndexes);
    $currentPeople = $rs['people'];
    $createdIndexes = $rs['indexes'];
    $rs = makeOneTitleChiefs($kachouCount, TITLE_KACHOU, $currentPeople, $createdIndexes);
    $currentPeople = $rs['people'];
    $createdIndexes = $rs['indexes'];
    $rs = makeOneTitleChiefs($keichouCount, TITLE_KEICHOU, $currentPeople, $createdIndexes);
    $currentPeople = $rs['people'];
    $createdIndexes = $rs['indexes'];
    $rs = makeOneTitleChiefs($shuninCount, TITLE_SHUNIN, $currentPeople, $createdIndexes);
    $currentPeople = $rs['people'];
    $createdIndexes = $rs['indexes'];
    return $currentPeople;
}

/**
 * Make chiefs of department's specific title
 *
 * @param [type] $title
 * @return void
 */
function makeOneTitleChiefs($count, $title, $currentPeople, $createdIndexes) {
    for ($i = 0; $i < $count; $i++) {
        $putIndex = getPutIndex($currentPeople, $createdIndexes);
        $currentPeople[$putIndex]->setTitle($title);
        $createdIndexes[] = $putIndex;
    }
    return [
        'people' => $currentPeople,
        'indexes' => $createdIndexes
    ];
}

function getPutIndex($currentPeople, $createdIndexes) {
    $putIndex = mt_rand(0, count($currentPeople) - 1);
    while(in_array($putIndex, $createdIndexes)) {
        $putIndex = mt_rand(0, count($currentPeople) - 1);
    }
    return $putIndex;
}

function generateRandomPeople(int $count, int $minAge, int $maxAge, string $title, string $departmentName = null) {
    global $faker;
    $people = [];
    for ($i=0; $i < $count; $i++) {
        $genders = ['male', 'female'];
        $randGenderIndex = mt_rand(0, 1);
        $gender = $genders[$randGenderIndex];
        $age = $faker->numberBetween($minAge, $maxAge);
        $fullName = $faker->name($gender);
        $people[] = new People($fullName, $gender, $age, $title, $departmentName);
    }
    return $people;
}

function exportCsv($data, $fileName) {
    $fp = fopen($fileName, 'w');
    // Add header to config utf-8
    fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF));
    // Add column name
    $colNames = ['Name', 'Gender', 'Age', 'Department', 'Job Title'];
    fputcsv($fp, $colNames);
    foreach ($data as $line) {
        fputcsv($fp, explode(",", $line));
    }
    fclose($fp);
    echo("Exported to csv successfully");
}

$total = 300;
$input = [45, 10, 10, 30, 5];
$input1 = [45, 10, 10, 30, 5];
$input2 = [10, 10, 30, 30, 20];
$input3 = [40, 10, 35, 10, 5];
$countA = (int) ($input[0] * $total) / 100;
$countB = (int) ($input[1] * $total) / 100;
$countC = (int) ($input[2] * $total) / 100;
$countD = (int) ($input[3] * $total) / 100;
$countE = $total - array_sum([$countA, $countB, $countC, $countD]);
$groupAPeople = generateRandomPeople($countA, 20, 29, TITLE_OTHERS);
$groupBPeople = generateRandomPeople($countB, 30, 39, TITLE_OTHERS);
$groupCPeople = generateRandomPeople($countC, 40, 49, TITLE_OTHERS);
$groupDPeople = generateRandomPeople($countD, 50, 59, TITLE_OTHERS);
$groupEPeople = generateRandomPeople($countE, 60, 69, TITLE_OTHERS);
$randPeople = [
    ...$groupAPeople,
    ...$groupBPeople,
    ...$groupCPeople,
    ...$groupDPeople,
    ...$groupEPeople,
];
shuffle($randPeople);
var_dump($randPeople);

$deptPercent = [25, 10, 10, 25, 30];
$deptPercent1 = [25, 10, 10, 25, 30];
$deptPercent2 = [30, 10, 5, 30, 25];
$deptPercent3 = [25, 15, 40, 10, 10];
$deptCountA = (int) ($deptPercent[0] * $total) / 100;
$deptCountB = (int) ($deptPercent[1] * $total) / 100;
$deptCountC = (int) ($deptPercent[2] * $total) / 100;
$deptCountD = (int) ($deptPercent[3] * $total) / 100;
$deptCountE = $total - array_sum([$deptCountA, $deptCountB, $deptCountC, $deptCountD]);

$createDept = function($title, $fromIndex) use($total) {
    for ($i = 0; $i < $total; $i++) {

    }
}


// $departments = [
//     new Department(DEPT_SALE, $ageProp['20-29'], $ageProp['30-39'], $ageProp['40-49'], $ageProp['50-59'], $ageProp['60-69']),
//     new Department(DEPT_MANAGEMENT, $ageProp['20-29'], $ageProp['30-39'], $ageProp['40-49'], $ageProp['50-59'], $ageProp['60-69']),
//     new Department(DEPT_DEVELOPMENT, $ageProp['20-29'], $ageProp['30-39'], $ageProp['40-49'], $ageProp['50-59'], $ageProp['60-69']),
//     new Department(DEPT_CONSTRUCTION, $ageProp['20-29'], $ageProp['30-39'], $ageProp['40-49'], $ageProp['50-59'], $ageProp['60-69']),
//     new Department(DEPT_DESIGN, $ageProp['20-29'], $ageProp['30-39'], $ageProp['40-49'], $ageProp['50-59'], $ageProp['60-69'])
// ];
// $organization = new Organization("ABC-const", $departments, $deptProp, 300);

// try {
//     $randomEmployees = generateRandomPeopleInOrganization($organization);
//     $data = $serializer->serialize($randomEmployees, 'json');
//     // var_dump($data);
//     $lines = [];
//     foreach ($randomEmployees as $employee) {
//         $lines[] = $employee->getLineData();
//     }
//     exportCsv($lines, "newData3.csv");
//     // var_dump($lines);
// } catch (InvalidArgumentException $ex) {
//     echo($ex->getMessage());
// }