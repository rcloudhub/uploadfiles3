import tkinter as tk
from tkinter import filedialog
import boto3
from botocore.exceptions import NoCredentialsError

# Set your AWS credentials and region
AWS_ACCESS_KEY_ID = 'AKIA2UC3A23OPRRF74DU'
AWS_SECRET_ACCESS_KEY = 'w1ZHb79E55O1jTfwGSaILQYyevhogg3EYeStVE8y'
AWS_REGION = 'eu-north-1'
BUCKET_NAME = 'rcloudhubn'

def upload_file_to_s3(file_path, key_name):
    try:
        s3 = boto3.client('s3', aws_access_key_id=AWS_ACCESS_KEY_ID,
                          aws_secret_access_key=AWS_SECRET_ACCESS_KEY,
                          region_name=AWS_REGION)
        s3.upload_file(file_path, BUCKET_NAME, key_name)
        print("File uploaded successfully.")
    except NoCredentialsError:
        print("AWS credentials not available or invalid.")

def select_file():
    file_path = filedialog.askopenfilename()
    if file_path:
        upload_key_name = file_path.split('/')[-1]  # Use the filename as the key in S3
        upload_file_to_s3(file_path, upload_key_name)
        status_label.config(text="File uploaded successfully.")

# Create the Tkinter window
window = tk.Tk()
window.title("S3 File Upload")

# Create a button to select a file
select_button = tk.Button(window, text="Select File", command=select_file)
select_button.pack(pady=50)

# Create a label to show upload status
status_label = tk.Label(window, text="")
status_label.pack()

# Start the Tkinter event loop
window.mainloop()
