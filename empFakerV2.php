<?php
require 'vendor/autoload.php';
// require_once '/path/to/Faker/src/autoload.php';

use Carbon\Carbon;

const ONE_HUNDRED_PERCENT = 100;
const DEPARTMENT = 'department';
const JOB_TITLE = 'job_title';
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

// Get faker
$faker = Faker\Factory::create('ja_JP');

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

$total = 300;
$input = [40, 10, 35, 10, 5];
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

$deptPercent = [25, 15, 40, 10, 10];
$deptPercent1 = [25, 10, 10, 25, 30];
$deptPercent2 = [30, 10, 5, 30, 25];
$deptPercent3 = [25, 15, 40, 10, 10];
$deptCountA = (int) ($deptPercent[0] * $total) / 100;
$deptCountB = (int) ($deptPercent[1] * $total) / 100;
$deptCountC = (int) ($deptPercent[2] * $total) / 100;
$deptCountD = (int) ($deptPercent[3] * $total) / 100;
$deptCountE = $total - array_sum([$deptCountA, $deptCountB, $deptCountC, $deptCountD]);
$mapDeptCounts = [
    DEPT_SALE => $deptCountA,
    DEPT_MANAGEMENT => $deptCountB,
    DEPT_DEVELOPMENT => $deptCountC,
    DEPT_CONSTRUCTION => $deptCountD,
    DEPT_DESIGN => $deptCountE,
];
$randPeople = createRandPeopleWithDept($mapDeptCounts, $randPeople);

try {
    $lines = [];
    foreach ($randPeople as $employee) {
        $lines[] = $employee->getLineData();
    }
    var_dump($lines);
    exportCsv($lines, "newData3.csv");
} catch (InvalidArgumentException $ex) {
    echo($ex->getMessage());
}

function createRandPeopleWithDept($mapDeptCounts, $randPeople) {
    $createDeptFromIdx = 0;
    foreach ($mapDeptCounts as $department => $count) {
        $mapChiefCounts = [
            TITLE_BUCHOU => ROLE_CHIEF_COUNTS[$department][TITLE_BUCHOU],
            TITLE_KACHOU => ROLE_CHIEF_COUNTS[$department][TITLE_KACHOU],
            TITLE_KEICHOU => ROLE_CHIEF_COUNTS[$department][TITLE_KEICHOU],
            TITLE_SHUNIN => ROLE_CHIEF_COUNTS[$department][TITLE_SHUNIN]
        ];
        $randPeople = setList($createDeptFromIdx, $count, $randPeople, $department, DEPARTMENT);
        $createChiefFromIdx = $createDeptFromIdx;
        foreach ($mapChiefCounts as $title => $chiefCount) {
            $randPeople = setList($createChiefFromIdx, $chiefCount, $randPeople, $title, JOB_TITLE);
            $createChiefFromIdx += $chiefCount;
        }
        $createDeptFromIdx += $count;
    }
    return $randPeople;
}

function setList($start, $count, $people, $value, $type) {
    for ($i = $start; $i < $start + $count; $i++) {
        switch ($type) {
            case DEPARTMENT:
                $people[$i]->setDepartment($value);
                break;
            case JOB_TITLE:
                $people[$i]->setTitle($value);
                break;
            default:
                break;
        }
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