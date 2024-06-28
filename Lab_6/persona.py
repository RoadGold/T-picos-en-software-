import re

def parse_puml(filename):
    with open(filename, 'r') as file:
        lines = file.readlines()
        classes = {}
        current_class = None
        class_pattern = re.compile(r'class (\w+) {')
        attribute_pattern = re.compile(r'\s*\+\-: (\w+)')
        # method_pattern = re.compile(r'\+(\w+)\((.*?)\): (\w+)')
        for line in lines:
            class_match = class_pattern.match(line)
            if class_match:
                current_class = class_match.group(1)
                classes[current_class] = {"attributes": [], "methods": []}
                continue
            if current_class:
                attribute_match = attribute_pattern.match(line)
                if attribute_match:
                    visibility, attribute_type = attribute_match.groups()
                    classes[current_class]["attributes"].append((visibility, attribute_type))
                    continue
        return classes

def generate_python_code(classes):
    code = []
    type_mapping = {
        "String": "str",
        "Integer": "int",
        "Float": "float",
        "Boolean": "bool",
        "Long": "int",
        "Date": "str",
        "String[]": "List[str]",
        "Map<String, String>": "Dict[str, str]",
        "List<String>": "List[str]"
    }
    for class_name, details in classes.items():
        code.append(f"class {class_name}:")
        # Constructor
        code.append("    def __init__(self):")
        for visibility, attribute_type in details["attributes"]:
            attr_name = visibility.strip()
            py_type = type_mapping.get(attribute_type, "Any")
            code.append(f"        self.{attr_name}: {py_type} = None")
        code.append("")
    return "\n".join(code)

if __name__ == "__main__":
    puml_file = "persona.puml"
    classes = parse_puml(puml_file)
    python_code = generate_python_code(classes)
    print(python_code)
