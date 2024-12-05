"""
Install the Google AI Python SDK

$ pip install google-generativeai
"""

#This python script will take the job description/qualifications etc. and then the user's information.
#it will inject both into the prompt to generate the section of the resume. 
#the user should be able to use casual language and the LLM will make it sound professional and tailor 
#it to the job description.

import os
from dotenv import load_dotenv
import google.generativeai as genai
import sys

user_input = sys.argv[1]
arg_type = sys.argv[2]

#will insert the desired resume section into the prompt, could edit these definitions to be more detailed for the LLM.
def resume_section(arg_type):
    section = ''
    match arg_type:
        case "obj":
            section = 'objective statement'
        case "work":
            section = 'work experience'
        case "edu":
            section = 'education'
        case "info":
            section = 'additional information'
    return section

#insert API key
load_dotenv()
api_key = os.getenv('API_KEY')
genai.configure(api_key=api_key)

# Create the model
generation_config = {
  "temperature": 1,
  "top_p": 0.95,
  "top_k": 64,
  "max_output_tokens": 8192,
  "response_mime_type": "text/plain",
}

model = genai.GenerativeModel(
  model_name="gemini-1.5-flash",
  generation_config=generation_config,
  # safety_settings = Adjust safety settings
  # See https://ai.google.dev/gemini-api/docs/safety-settings
)    

model = genai.GenerativeModel("gemini-1.5-flash")
content = f"""
You are a professional copywrighter.
Write a complete and professional {resume_section(arg_type)} section of a resume
based on the given information: '{user_input}'.
"""
response = model.generate_content(content)
print(response.text)
