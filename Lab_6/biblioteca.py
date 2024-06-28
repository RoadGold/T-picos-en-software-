class PlantUMLParser:
    def __init__(self, plantuml_content, file_name):
        self.plantuml_content = plantuml_content
        self.tables = {}
        self.db_name = file_name

    def parse(self):
        self._parse_entities()
        self._parse_relations()

    def _parse_entities(self):
        entity_pattern = re.compile(r'class\s+(\w+)\s+\{\s+([\s\S]+?)\s+\}')
        attribute_pattern = re.compile(r'\+\s*(\w+):\s*(\w+)')
        for entity_match in entity_pattern.finditer(self.plantuml_content):
            table_name = entity_match.group(1)
            attributes_block = entity_match.group(2)
            attributes = {}
            for attr_match in attribute_pattern.finditer(attributes_block):
                attr_name = attr_match.group(1)
                attr_type = attr_match.group(2)
                attributes[attr_name] = self._map_type(attr_type)
            self.tables[table_name] = {'attributes': attributes, 'relations': []}

    def _parse_relations(self):
        relation_pattern = re.compile(r'(\w+)\s+"[\d]+"\s+--\s+"[\d..*]+"\s+(\w+)')
        for relation_match in relation_pattern.finditer(self.plantuml_content):
            table1 = relation_match.group(1)
            table2 = relation_match.group(2)
            if table1 in self.tables and table2 in self.tables:
                self.tables[table2]['relations'].append(table1)

    def generate_sql_code(self):
        sql_code = f"CREATE DATABASE {self.db_name};\n\n"
        sql_code += f"USE {self.db_name};\n\n"
        for table_name, table_info in self.tables.items():
            attributes = table_info['attributes']
            sql_code += f"CREATE TABLE {table_name} (\n"
            sql_code += f" id INT PRIMARY KEY AUTO_INCREMENT,\n"
            for attr_name, attr_type in attributes.items():
                sql_code += f" {attr_name} {attr_type},\n"
            # Add foreign key columns
            for related_table in table_info['relations']:
                sql_code += f" {related_table.lower()}_id INT,\n"
            sql_code = sql_code.rstrip(',\n') + "\n);\n\n"
            for table_name, table_info in self.tables.items():
                for related_table in table_info['relations']:
                    sql_code += f"ALTER TABLE {table_name}"
                    sql_code += f" ADD CONSTRAINT fk_{table_name}_{related_table}"
                    sql_code += f" FOREIGN KEY ({related_table.lower()}_id)"
                    sql_code += f" REFERENCES {related_table}(id);\n\n"
        return sql_code

    def _map_type(self, plantuml_type):
        type_mapping = {
            'Integer': 'INT',
            'String': 'VARCHAR(255)',
            'Float': 'FLOAT',
            'Date': 'DATE',
            'Boolean': 'BOOLEAN'
        }
        return type_mapping.get(plantuml_type, 'VARCHAR(255)')


if __name__ == "__main__":
    # Leer el archivo PlantUML
    with open("biblioteca.puml", "r") as file:
        plantuml_content = file.read()
        parser = PlantUMLParser(plantuml_content, file.name.split(".")[0])
        parser.parse()
        sql_code = parser.generate_sql_code()
    # Guardar las sentencias SQL generadas en un archivo
    with open("biblioteca.sql", "w") as file:
        file.write(sql_code)
    print("Esquema SQL generado con éxito.")
