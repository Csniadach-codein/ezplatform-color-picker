<?php


namespace Codein\eZColorPicker\FieldType\ColorPicker;


use Codein\eZColorPicker\Form\Type\ColorPickerType;
use Ibexa\ContentForms\Data\Content\FieldData;
use Ibexa\ContentForms\Data\FieldDefinitionData;
use Ibexa\ContentForms\FieldType\FieldDefinitionFormMapperInterface;
use Ibexa\ContentForms\FieldType\FieldValueFormMapperInterface;
use Symfony\Component\Form\FormInterface;

class FormMapper implements FieldValueFormMapperInterface, FieldDefinitionFormMapperInterface
{
    public function mapFieldDefinitionForm(FormInterface $fieldDefinitionForm, FieldDefinitionData $data)
    {
        $fieldDefinitionForm
            ->add(
                $fieldDefinitionForm->getConfig()->getFormFactory()->createBuilder()
                    ->create(
                        'defaultValue',
                        ColorPickerType::class, [
                            'required' => false,
                            'label' => 'codeincolor.default.color',
                        ]
                    )
                    ->setAutoInitialize(false)->getForm()
            );
    }

    public function mapFieldValueForm(FormInterface $fieldForm, FieldData $data)
    {
        $definition = $data->fieldDefinition;
        $fieldForm->add('value', ColorPickerType::class, [
            'required' => $definition->isRequired,
            'label' => $definition->getName(),
            'defaultValue' => $definition->defaultValue,
        ]);
    }
}