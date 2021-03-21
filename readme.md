# Alfred Temperature Converter

This workflow will output temperatures converted between Fahrenheit and Celsius.

## Converting Temperatures
The workflow can be activated by entering the keyword `tc` (short for Temperature Converter) into Alfred.

Once the workflow is activated, input your temperature in whole numbers only (no decimals).

If you have set up a default temperature scale, it will be applied automatically.

If you haven't yet set a default, or if you would like to convert in the opposite direction, add an 'f' for Fahrenheit or a 'c' for Celsius. Be sure to add the letter corresponding the the temperature you are converting *from*.

## Setting a Default Scale

You can select either Fahrenheit or Celsius as the default scale that you usually enter temperatures in.

Launch the workflow with the usual keyword, and arrow down to the `Set default temperature scale` option.

Use `CMD + RETURN` to set your default to Celsius. Use `OPTION + RETURN` to set your default to Fahrenheit.

Please allow 10-15 seconds for Alfred to update the Workflow configuration files before relaunching the workflow.

You may change this default at any time.

## Conversion Formatting

By default, the workflow will output the original temperature along with the converted temperature, like so:

*32°F/0°C*

However, if you hold the `CMD` key while processing your conversion, it will output just the converted temperature, like so:

*0°C*