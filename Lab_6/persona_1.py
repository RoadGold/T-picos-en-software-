import re

def parse_puml(filename):
    with open(filename, 'r') as file:
        lines = file.readlines()
        classes = {}
        current_class = None
        class_pattern = re.compile(r'class (\w+) {')
        attribute_pattern = re.compile(r'\s*\+(\w+): (\w+)')
        for line in lines:
            class_match = class_pattern.match(line)
            if class_match:
                current_class = class_match.group(1)
                classes[current_class] = []
                continue
            if current_class:
                attribute_match = attribute_pattern.match(line)
                if attribute_match:
                    visibility, attribute_type = attribute_match.groups()
                    classes[current_class].append((visibility.strip(), attribute_type))
                    continue
        return classes

def generate_html_form(classes):
    type_mapping = {
        "String": "text",
        "Integer": "number",
        "Float": "number",
        "Boolean": "checkbox",
        "Long": "number",
        "Date": "date",
        "String[]": "text",
        "Map<String, String>": "text",
        "List<String>": "text"
    }
    html_forms = []
    for class_name, attributes in classes.items():
        form = []
        form.append(f"<h2>Formulario de {class_name}</h2>")
        form.append(f"<form id='{class_name.lower()}-form'>")
        for attr_name, attr_type in attributes:
            html_type = type_mapping.get(attr_type, "text")
            if html_type == "checkbox":
                form.append(f" <label for='{attr_name}'>" +
                            f"{attr_name.capitalize()}:</label>")
                form.append(f" <input type='{html_type}'" +
                            f"id='{attr_name}' name='{attr_name}'><br>")
            else:
                form.append(f" <label for='{attr_name}'>" +
                            f"{attr_name.capitalize()}:</label>")
                form.append(f" <input type='{html_type}'" +
                            f"id='{attr_name}' name='{attr_name}'><br>")
        form.append(" <input type='submit' value='Submit'>")
        form.append("</form>")
        html_forms.append("\n".join(form))
    return "\n".join(html_forms)

if __name__ == "__main__":
    puml_file = "persona.puml"
    classes = parse_puml(puml_file)
    html_form = generate_html_form(classes)
    with open("persona.html", "w") as file:
        file.write(html_form)
    print("Formulario HTML generado con éxito.")
