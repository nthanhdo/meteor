<?php
namespace Neometeor\Library;

use App\Http\Controllers\Controller;

/**
 * Class NeoLibraryController
 * @package Neometeor\Library
 */
class NeoLibrary extends Controller
{
    /**
     * Function to create a table in a view
     *
     * @param array $multiArray
     * @param array|null $restrict * EX: array('numeric key' => 'column name') *
     * @param string|null $orderBy
     * @param string $sort
     *
     * @return string
     */
    public static function table(array $multiArray, array $restrict = null, string $orderBy = null, $sort = null)
    {
        if (!is_null($restrict) && !is_null($orderBy) && in_array($orderBy, $restrict)) {
            $orderBy = null;
        }
        if (!is_null($orderBy)) {
            $multiArray['orderBy'] = $orderBy;
            switch (strtoupper($sort)) {
                case "DESC" || "DOWN" || "-":
                    $multiArray['sort'] = 'DESC';
                    break;
                default:
                    $multiArray['sort'] = 'ASC';
            }
            usort($multiArray, 'NeoLibrary::sortByKey');
        }
        if (!is_null($restrict)) {
            $newArray = array();
            foreach ($multiArray as $array) {
                foreach ($restrict as $key) {
                    unset($array[$key]);
                }
                $newArray[] = $array;
            }
            $multiArray = $newArray;
        }
        $multiArray = array_values($multiArray);
        $table = '<table>';
        $table .= '<thead>';
        $table .= '<tr>';
        foreach ($multiArray[0] as $columnName => $value) {
            $table .= '<th>' . NeoLibrary::prettyUC($columnName) . '</th>';
        }
        $table .= '</tr>';
        $table .= '</thead>';
        $table .= '<tbody>';
        foreach ($multiArray as $row) {
            $table .= '<tr>';
            foreach ($row as $column => $data) {
                $table .= '<td>' . $data . '</td>';
            }
            $table .= '</tr>';
        }
        $table .= '</tbody>';
        $table .= '</table>';

        return $table;
    }

    /**
     * Function to create a dropdown in a view
     *
     * @param $name
     * @param array $options * EX: array('database value' => 'dropdown text') *
     *
     * @return string
     */
    public static function dropdown($name, array $options)
    {
        $dropdown_label = NeoLibrary::label($name, NeoLibrary::webReadyText($name) . '_dropdown');
        $dropdown = '<select id="' . NeoLibrary::webReadyText($name) . '">';
        foreach ($options as $value => $text) {
            $dropdown .= '<option value = "' . $value . '">' . $text . '</option >';
        }
        $dropdown .= '</select>';
        return $dropdown_label . '<br>'. $dropdown;
    }

    /**
     * Function to create a link in a view
     *
     * @param $text
     * @param $target
     * @param array $options * EX: array('attribute tag' => 'value') *
     *
     * @return string
     */
    public static function link($text, $target, array $options = null)
    {
        $link =  '<a href="' . $target . '"';
        if (!is_null($options)) {
            foreach ($options as $attribute => $value) {
                $link .= ' ' . $attribute . '="' . $value . '"';
            }
        }
        $link .= '>' . $text . '</a>';
        return $link;

    }

    /**
     * Function to create a textfield in a view
     *
     * @param $name
     * @param $content
     * @param array $options * EX: array('attribute tag' => 'value') *
     *
     * @return string
     */
    public static function textfield($name, $content, array $options = null)
    {
        $textfield_label = NeoLibrary::label($name, NeoLibrary::webReadyText($name) . '_textfield');
        $textfield =  '<textarea id="' . NeoLibrary::webReadyText($name) . '" name="' . $name . '"';
        if (!is_null($options)) {
            foreach ($options as $attribute => $value) {
                $textfield .= ' ' . $attribute . '="' . $value . '"';
            }
        }
        $textfield .= '>' . $content . '</textarea>';
        return $textfield_label . '<br>'. $textfield;
    }

    /**
     * Function to create a label in a view
     *
     * @param $content
     * @param $for
     * @param array|null $options * EX: array('attribute tag' => 'value') *
     *
     * @return string
     */
    public static function label($content, $for, array $options = null)
    {
        $label = '<label for="' . $for . '"';
        if (!is_null($options)) {
            foreach ($options as $attribute => $value) {
                $label .= ' ' . $attribute . '="' . $value . '"';
            }
        }
        $label .= '>' . $content . '</label>';
        return $label;
    }

    /**
     * Takes database table values and makes them pretty for the user
     * [Upper-cases and spaces words]
     *
     * @param $str
     * @return mixed
     */
    public static function prettyUC($str)
    {
        return ucwords(str_replace("_", " ", $str));
    }

    /**
     * @param $str
     * @return mixed
     */
    public static function webReadyText($str)
    {
        return strtolower(str_replace(" ", "_", $str));
    }

    /**
     * Takes a value and makes the wording appropriate for HTML tags
     * [Lower-cases and replaces spaces with underscores]
     *
     * @param $a
     * @param $b
     * @return int
     */
    public static function sortByKey($a, $b)
    {
        $orderBy = array_pull($a, 'orderBy');
        $sort = array_pull($a, 'sort');

        if ($a[$orderBy] == $b[$orderBy]) {
            return 0;
        }
        if ($sort == 'DESC') {
            return ($a[$orderBy] > $b[$orderBy]) ? -1 : 1;
        } else {
            return ($a[$orderBy] < $b[$orderBy]) ? -1 : 1;
        }
    }

    /**
     * @return array
     */
    public static function testArray()
    {
        return array(
            'First' => [
                'first_name' => 'Ken',
                'last_name' => 'Goodman',
                'age' => '35',
                'email' => 'kgoodman@test.lar',
                'hobby' => 'reading',
                'job' => 'surgeon',
            ],
            'Second' => [
                'first_name' => 'Aryn',
                'last_name' => 'Liger',
                'age' => '29',
                'email' => 'aliger@test.co',
                'hobby' => 'hiking',
                'job' => 'physicist',
            ],
            3 => [
                'first_name' => 'Guy',
                'last_name' => 'Prettyeyes',
                'age' => '21',
                'email' => 'gpretty@someplace.new',
                'hobby' => 'dating',
                'job' => 'model',
            ],
            '4' => [
                'first_name' => 'Test',
                'last_name' => 'Testerson',
                'age' => '40',
                'email' => 'ttesterson@test.co',
                'hobby' => 'gaming',
                'job' => 'programmer',
            ],
            'Five' => [
                'first_name' => 'Megan',
                'last_name' => 'Greeves',
                'age' => '28',
                'email' => 'mgreeves@work.it',
                'hobby' => 'reading',
                'job' => 'police officer',
            ],
            6 => [
                'first_name' => 'Archer',
                'last_name' => 'Goodman',
                'age' => '33',
                'email' => 'agoodman@test.lar',
                'hobby' => 'cooking',
                'job' => 'store clerk',
            ],
        );
    }

    /**
     * @return array
     */
    public static function testRestrict()
    {
        return array('age','email');
    }

    /**
     * @return string
     */
    public static function testOrderBy()
    {
        return 'hobby';
    }

    /**
     * @return array
     */
    public static function testDropdown()
    {
        return array(
            'up' => 'Up',
            'down' => 'Down',
            'left' => 'Left',
            'right' => 'Right',
            'nowhere' => 'Nowhere',
            'somewhere' => 'Somewhere',
        );
    }

    /**
     * @return string
     */
    public static function testTextfield()
    {
        return 'What we have here is a text field. It should display this according to any CSS changes you make.';
    }
}
