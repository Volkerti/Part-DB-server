<?php
/**
 *
 * part-db version 0.1
 * Copyright (C) 2005 Christoph Lechner
 * http://www.cl-projects.de/
 *
 * part-db version 0.2+
 * Copyright (C) 2009 K. Jacobs and others (see authors.php)
 * http://code.google.com/p/part-db/
 *
 * Part-DB Version 0.4+
 * Copyright (C) 2016 - 2019 Jan Böhmer
 * https://github.com/jbtronics
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA
 *
 */

namespace App\Form\Part;

use App\Entity\Parts\Supplier;
use App\Entity\PriceInformations\Orderdetail;
use App\Form\Type\StructuralEntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderdetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('supplierpartnr', TextType::class, [
            'required' => false,
            'empty_data' => ""
        ]);

        $builder->add('supplier', StructuralEntityType::class, ['class' => Supplier::class, 'disable_not_selectable' => true]);

        $builder->add('supplierProductUrl', UrlType::class, [
            'required' => false,
            'empty_data' => ""
        ]);

        $builder->add('obsolete', CheckboxType::class, [
            'required' => false,
            'label_attr' => ['class' => 'checkbox-custom']
        ]);

        //Attachment section
        $builder->add('priceDetails', CollectionType::class, [
            'entry_type' => PricedetailType::class,
            'allow_add' => true, 'allow_delete' => true,
            'label' => false,
            'by_reference' => false
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Orderdetail::class,
            'error_bubbling' => false,
        ]);
    }
}