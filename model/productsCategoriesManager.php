<?php

class productsCategoriesManager extends dbConnect
{
    public function removeCzech($text)
    {
        $convert_table = ['ä'=>'a',
        'Ä'=>'A',
        'á'=>'a',
        'Á'=>'A',
        'à'=>'a',
        'À'=>'A',
        'ã'=>'a',
        'Ã'=>'A',
        'â'=>'a',
        'Â'=>'A',
        'č'=>'c',
        'Č'=>'C',
        'ć'=>'c',
        'Ć'=>'C',
        'ď'=>'d',
        'Ď'=>'D',
        'ě'=>'e',
        'Ě'=>'E',
        'é'=>'e',
        'É'=>'E',
        'ë'=>'e',
        'Ë'=>'E',
        'è'=>'e',
        'È'=>'E',
        'ê'=>'e',
        'Ê'=>'E',
        'í'=>'i',
        'Í'=>'I',
        'ï'=>'i',
        'Ï'=>'I',
        'ì'=>'i',
        'Ì'=>'I',
        'î'=>'i',
        'Î'=>'I',
        'ľ'=>'l',
        'Ľ'=>'L',
        'ĺ'=>'l',
        'Ĺ'=>'L',
        'ń'=>'n',
        'Ń'=>'N',
        'ň'=>'n',
        'Ň'=>'N',
        'ñ'=>'n',
        'Ñ'=>'N',
        'ó'=>'o',
        'Ó'=>'O',
        'ö'=>'o',
        'Ö'=>'O',
        'ô'=>'o',
        'Ô'=>'O',
        'ò'=>'o',
        'Ò'=>'O',
        'õ'=>'o',
        'Õ'=>'O',
        'ő'=>'o',
        'Ő'=>'O',
        'ř'=>'r',
        'Ř'=>'R',
        'ŕ'=>'r',
        'Ŕ'=>'R',
        'š'=>'s',
        'Š'=>'S',
        'ś'=>'s',
        'Ś'=>'S',
        'ť'=>'t',
        'Ť'=>'T',
        'ú'=>'u',
        'Ú'=>'U',
        'ů'=>'u',
        'Ů'=>'U',
        'ü'=>'u',
        'Ü'=>'U',
        'ù'=>'u',
        'Ù'=>'U',
        'ũ'=>'u',
        'Ũ'=>'U',
        'û'=>'u',
        'Û'=>'U',
        'ý'=>'y',
        'Ý'=>'Y',
        'ž'=>'z',
        'Ž'=>'Z',
        'ź'=>'z',
        'Ź'=>'Z'
        ];

            $text_low = strtr($text, $convert_table);
            return $text_low;
    }
    
    public function getProductsCategories()
    {
        //Zjistí čísla kategorií produktů
        $ids = $this->connect()->query("SELECT * FROM wp_term_taxonomy WHERE taxonomy='product_cat'"); //Výpis všech řádků s hodnotou "product_cat"
        while($row = mysqli_fetch_array($ids))
        {
            if($row["parent"]==0) //Pokud je Parent 0, jedná se o kategorii
            {
                $categories_array[] = $row["term_taxonomy_id"];
            }
        }
        $imp_cat = implode(", ",$categories_array);
        $categories_names = $this->connect()->query("SELECT * FROM wp_terms WHERE term_id IN ($imp_cat)"); 
        while($row = mysqli_fetch_array($categories_names))
        {
            $categories[$row["term_id"]]=$row["name"];
        }
        return $categories;
    }
    
    
    public function getProductsSubCategories()
     {
        //Zjistí čísla kategorií produktů
        $ids = $this->connect()->query("SELECT * FROM wp_term_taxonomy WHERE taxonomy='product_cat'"); //Výpis všech řádků s hodnotou "product_cat"
        while($row = mysqli_fetch_array($ids))
        {
            if($row["parent"]>0) //Pokud je Parent 0, jedná se o kategorii
            {
                $subCategories_array[$row["term_taxonomy_id"]] = $row["parent"];
            }
        }
        foreach ($subCategories_array as $value => $parent) 
        {
            $subcat_name = $this->connect()->query("SELECT name FROM wp_terms WHERE term_id='$value'");
            $row=mysqli_fetch_array($subcat_name);
            $subcategories[$row["name"]] = $parent;
        }
        return($subcategories);
    }
    
    public function showProductsCategories()
    {
        
        foreach($this->getProductsCategories() as $key => $category)
        {
            $cat_czechless = $this->removeCzech($category);
            $cat = strtolower($cat_czechless);
            echo "<option class='cashboxCategory' value='$cat'><b>$category</b></option>";
            foreach($this->getProductsSubCategories() as $subcategory => $parent)
            {
                if($parent==$key)
                {
                    $subcat_czechless = $this->removeCzech($subcategory);
                    $subcat = strtolower($subcat_czechless);
                    echo "<option class='cashboxSubcategory' value='$subcat'>$subcategory</option>";
                }
            }
            echo "</optgroup>";
        } 
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

