import java.io.File
import kotlin.random.Random

/* Schema:
ID
Job Title
Organization
Division
Position Type
Internal Status
App Deadline
*/

fun main() {
    val jobs = mutableListOf<Job>()

    var currentJob = Job()
    File("jobs.txt").forEachLine { line ->
        if (line.startsWith("View  Shortlist Apply")) {
            val formattedString = line.removePrefix("View  Shortlist Apply\t\t");
            currentJob.ID = formattedString.substring(0, 6).toInt()
            currentJob.JobTitle = formattedString.substring(7, formattedString.length)
        } else {
            val remainingData = line.split("\t")
            currentJob.Organization = remainingData[0]
            currentJob.Division = remainingData[1]
            currentJob.PositionType = remainingData[2]
            currentJob.InternalStatus = remainingData[3]
            currentJob.AppDeadline = remainingData[4]
            jobs.add(currentJob)
            currentJob = Job()
        }
    }

    val companies = mutableListOf<Company>()
    val charPool : List<Char> = ('a'..'z') + ('A'..'Z') + ('0'..'9')
    jobs.forEach { job ->
        if (!companies.any { it.Organization == job.Organization }) {
            val pwd = (1..8)
                .map { Random.nextInt(0, charPool.size) }
                .map(charPool::get)
                .joinToString("")

            val location = listOf("Canada", "US", "Canada", "Europe", "Canada", "Canada", "US")

            companies.add(Company(job.Organization, Random.nextInt(1, 101) / 10.0F, pwd, location.random()))
        }
    }
    companies.forEach {
        println(it.Organization + "\t" + it.Rating + "\t" + it.Password + "\t" + it.Location)
    }
}

data class Job(
    var ID: Int = 0, // primary key
    var JobTitle: String = "",
    var Organization: String = "",
    var Division: String = "",
    var PositionType: String = "",
    var InternalStatus: String = "",
    var AppDeadline: String = "",
    var Description: String = "This is an awesome job."
)

data class Company(
    var Organization: String = "",
    var Rating: Float = 0.0F,
    var Password: String = "",
    var Location: String = ""
//    var Password: String = "Password",
//    var Country: String = "Canada"
)

//App Status
//ID
//Job Title
//Organization
//Division
//Position Type
//Internal Status
//App Deadline